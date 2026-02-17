<?php

namespace App\Services;

use App\Enums\TransactionStatus;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprovalService
{
    public function __construct(private
        FinancialService $financialService
        )
    {
    }

    /**
     * Submit a transaction for approval.
     */
    public function submitForApproval(Transaction $transaction): Transaction
    {
        if (!$transaction->status->canTransitionTo(TransactionStatus::Submitted)) {
            throw new \InvalidArgumentException(
                "Transaksi dengan status '{$transaction->status->label()}' tidak dapat disubmit untuk approval."
                );
        }

        return DB::transaction(function () use ($transaction) {
            $transaction->update([
                'status' => TransactionStatus::Submitted,
            ]);

            activity()
                ->performedOn($transaction)
                ->causedBy(Auth::user())
                ->withProperties(['old_status' => 'draft', 'new_status' => 'submitted'])
                ->log('Transaction submitted for approval');

            return $transaction->fresh();
        });
    }

    /**
     * Approve a transaction.
     */
    public function approve(Transaction $transaction): Transaction
    {
        if (!$transaction->status->canTransitionTo(TransactionStatus::Approved)) {
            throw new \InvalidArgumentException(
                "Transaksi dengan status '{$transaction->status->label()}' tidak dapat diapprove."
                );
        }

        return DB::transaction(function () use ($transaction) {
            $transaction->update([
                'status' => TransactionStatus::Approved,
                'approved_by' => Auth::id(),
                'approved_at' => now(),
            ]);

            activity()
                ->performedOn($transaction)
                ->causedBy(Auth::user())
                ->withProperties(['old_status' => 'submitted', 'new_status' => 'approved'])
                ->log('Transaction approved');

            // Clear financial caches since balances changed
            $this->financialService->clearCache();

            return $transaction->fresh();
        });
    }

    /**
     * Reject a transaction with reason.
     */
    public function reject(Transaction $transaction, string $reason): Transaction
    {
        if (!$transaction->status->canTransitionTo(TransactionStatus::Rejected)) {
            throw new \InvalidArgumentException(
                "Transaksi dengan status '{$transaction->status->label()}' tidak dapat ditolak."
                );
        }

        return DB::transaction(function () use ($transaction, $reason) {
            $transaction->update([
                'status' => TransactionStatus::Rejected,
                'rejection_reason' => $reason,
                'approved_by' => Auth::id(),
                'approved_at' => now(),
            ]);

            activity()
                ->performedOn($transaction)
                ->causedBy(Auth::user())
                ->withProperties([
                'old_status' => 'submitted',
                'new_status' => 'rejected',
                'reason' => $reason,
            ])
                ->log('Transaction rejected');

            // Clear financial caches for consistency
            $this->financialService->clearCache();

            return $transaction->fresh();
        });
    }

    /**
     * Get count of pending transactions.
     */
    public function getPendingCount(): int
    {
        return Transaction::pendingApproval()->count();
    }

    /**
     * Get all pending transactions.
     */
    public function getPendingTransactions(int $perPage = 15)
    {
        return Transaction::pendingApproval()
            ->with(['creator'])
            ->orderBy('created_at', 'asc')
            ->paginate($perPage);
    }
}
