<x-admin-layout>
    <x-slot name="header">Tambah Transaksi</x-slot>

    <div class="max-w-4xl">
        <div class="mb-6">
            <a href="{{ route('admin.transactions.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-emerald-600 transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Daftar Transaksi
            </a>
        </div>

        <livewire:transaction-form />
    </div>
</x-admin-layout>
