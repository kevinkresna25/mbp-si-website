<x-admin-layout>
    <x-slot name="header">Edit Transaksi - {{ $transaction->transaction_code }}</x-slot>

    <div class="max-w-4xl">
        <div class="mb-6">
            <a href="{{ route('admin.transactions.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-emerald-600 transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Daftar Transaksi
            </a>
        </div>

        @if($transaction->status->value === 'rejected' && $transaction->rejection_reason)
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                <p class="font-semibold text-sm">Alasan Penolakan:</p>
                <p class="text-sm mt-1">{{ $transaction->rejection_reason }}</p>
            </div>
        @endif

        <livewire:transaction-form :transaction="$transaction" />
    </div>
</x-admin-layout>
