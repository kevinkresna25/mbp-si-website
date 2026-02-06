<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Enums\TransactionStatus;
use App\Models\Transaction;
use App\Services\ApprovalService;
use App\Services\FinancialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function __construct(
        private FinancialService $financialService,
        private ApprovalService $approvalService,
    ) {}

    /**
     * Display a listing of transactions.
     */
    public function index(Request $request)
    {
        $query = Transaction::with(['creator', 'approver'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc');

        // Filter by status
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        // Filter by category
        if ($category = $request->get('category')) {
            $query->where('category_ziswaf', $category);
        }

        // Filter by type
        if ($type = $request->get('type')) {
            $query->where('type', $type);
        }

        // Filter by date range
        if ($from = $request->get('from')) {
            $query->whereDate('tanggal', '>=', $from);
        }
        if ($to = $request->get('to')) {
            $query->whereDate('tanggal', '<=', $to);
        }

        $transactions = $query->paginate(20)->withQueryString();

        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new transaction.
     */
    public function create()
    {
        return view('admin.transactions.create');
    }

    /**
     * Show the form for editing a transaction.
     */
    public function edit(Transaction $transaction)
    {
        // Only allow editing draft or rejected transactions
        if (!in_array($transaction->status, [TransactionStatus::Draft, TransactionStatus::Rejected])) {
            return redirect()->route('admin.transactions.index')
                ->with('error', 'Hanya transaksi berstatus Draft atau Ditolak yang dapat diedit.');
        }

        return view('admin.transactions.edit', compact('transaction'));
    }

    /**
     * Submit a transaction for approval.
     */
    public function submit(Transaction $transaction)
    {
        try {
            $this->approvalService->submitForApproval($transaction);
            return redirect()->route('admin.transactions.index')
                ->with('success', "Transaksi {$transaction->transaction_code} berhasil disubmit untuk approval.");
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('admin.transactions.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove a draft transaction.
     */
    public function destroy(Transaction $transaction)
    {
        if ($transaction->status !== TransactionStatus::Draft) {
            return redirect()->route('admin.transactions.index')
                ->with('error', 'Hanya transaksi berstatus Draft yang dapat dihapus.');
        }

        // Delete bukti foto if exists
        if ($transaction->bukti_foto) {
            Storage::disk('public')->delete($transaction->bukti_foto);
        }

        $code = $transaction->transaction_code;
        $transaction->delete();

        return redirect()->route('admin.transactions.index')
            ->with('success', "Transaksi {$code} berhasil dihapus.");
    }
}
