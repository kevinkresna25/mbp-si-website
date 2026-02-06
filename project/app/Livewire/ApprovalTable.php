<?php

namespace App\Livewire;

use App\Models\Transaction;
use App\Services\ApprovalService;
use Livewire\Component;
use Livewire\WithPagination;

class ApprovalTable extends Component
{
    use WithPagination;

    public bool $showRejectModal = false;
    public ?int $rejectingTransactionId = null;
    public string $rejectionReason = '';

    public function approve(int $transactionId): void
    {
        $transaction = Transaction::findOrFail($transactionId);
        $approvalService = app(ApprovalService::class);

        try {
            $approvalService->approve($transaction);
            session()->flash('success', "Transaksi {$transaction->transaction_code} berhasil disetujui.");
        } catch (\InvalidArgumentException $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function openRejectModal(int $transactionId): void
    {
        $this->rejectingTransactionId = $transactionId;
        $this->rejectionReason = '';
        $this->showRejectModal = true;
    }

    public function closeRejectModal(): void
    {
        $this->showRejectModal = false;
        $this->rejectingTransactionId = null;
        $this->rejectionReason = '';
    }

    public function reject(): void
    {
        $this->validate([
            'rejectionReason' => 'required|string|min:10|max:500',
        ], [
            'rejectionReason.required' => 'Alasan penolakan wajib diisi.',
            'rejectionReason.min' => 'Alasan penolakan minimal 10 karakter.',
        ]);

        $transaction = Transaction::findOrFail($this->rejectingTransactionId);
        $approvalService = app(ApprovalService::class);

        try {
            $approvalService->reject($transaction, $this->rejectionReason);
            session()->flash('success', "Transaksi {$transaction->transaction_code} ditolak.");
        } catch (\InvalidArgumentException $e) {
            session()->flash('error', $e->getMessage());
        }

        $this->closeRejectModal();
    }

    public function render()
    {
        $transactions = Transaction::pendingApproval()
            ->with(['creator'])
            ->orderBy('created_at', 'asc')
            ->paginate(15);

        return view('livewire.approval-table', [
            'transactions' => $transactions,
        ]);
    }
}
