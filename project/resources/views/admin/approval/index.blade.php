<x-admin-layout>
    <x-slot name="header">Approval Transaksi</x-slot>

    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-900">Antrian Approval</h2>
        <p class="text-sm text-gray-500">{{ $pendingCount }} transaksi menunggu persetujuan</p>
    </div>

    <livewire:approval-table />
</x-admin-layout>
