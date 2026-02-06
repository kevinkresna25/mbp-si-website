<x-public-layout>
    <x-slot name="title">Keuangan & Donasi</x-slot>

    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-emerald-700 to-emerald-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold">Transparansi Keuangan Masjid</h1>
                <p class="mt-3 text-lg text-emerald-200 max-w-2xl mx-auto">Laporan keuangan terbuka untuk seluruh jamaah. ZISWAF (Zakat, Infaq, Sedekah, Wakaf) dikelola secara amanah dan transparan.</p>
            </div>
        </div>
    </section>

    {{-- Balance Overview --}}
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Saldo Per Kategori ZISWAF</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($balances['categories'] as $cat)
                    @php
                        $icons = [
                            'zakat' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
                            'infaq' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                            'sedekah' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"/>',
                            'wakaf' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>',
                            'operasional' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>',
                        ];
                        $bgColors = [
                            'zakat' => 'from-blue-500 to-blue-600',
                            'infaq' => 'from-emerald-500 to-emerald-600',
                            'sedekah' => 'from-purple-500 to-purple-600',
                            'wakaf' => 'from-amber-500 to-amber-600',
                            'operasional' => 'from-gray-500 to-gray-600',
                        ];
                    @endphp
                    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden hover:shadow-lg transition">
                        <div class="bg-gradient-to-r {{ $bgColors[$cat['category']] ?? 'from-gray-500 to-gray-600' }} p-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $icons[$cat['category']] ?? '' !!}</svg>
                                </div>
                                <h3 class="text-lg font-bold text-white">{{ $cat['label'] }}</h3>
                            </div>
                        </div>
                        <div class="p-5">
                            <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($cat['balance'], 0, ',', '.') }}</p>
                            <div class="mt-2 flex items-center space-x-4 text-sm">
                                <span class="text-green-600">Masuk: Rp {{ number_format($cat['debit'], 0, ',', '.') }}</span>
                                <span class="text-red-500">Keluar: Rp {{ number_format($cat['credit'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Total --}}
            <div class="bg-emerald-800 text-white rounded-xl shadow-lg p-8 text-center">
                <p class="text-sm text-emerald-300 font-medium uppercase tracking-wider">Total Saldo Keseluruhan</p>
                <p class="text-4xl font-bold mt-2">Rp {{ number_format($balances['total_balance'], 0, ',', '.') }}</p>
                <div class="mt-3 flex items-center justify-center space-x-8 text-sm text-emerald-200">
                    <span>Total Pemasukan: <span class="text-white font-semibold">Rp {{ number_format($balances['total_debit'], 0, ',', '.') }}</span></span>
                    <span>Total Pengeluaran: <span class="text-white font-semibold">Rp {{ number_format($balances['total_credit'], 0, ',', '.') }}</span></span>
                </div>
            </div>
        </div>
    </section>

    {{-- Donation Targets --}}
    @if($donationTargets->count() > 0)
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Program Donasi Aktif</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($donationTargets as $target)
                    <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 hover:shadow-lg transition">
                        <div class="flex items-center justify-between mb-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                {{ $target->category_ziswaf->label() }}
                            </span>
                            @if($target->end_date)
                                <span class="text-xs text-gray-400">s.d. {{ $target->end_date->format('d M Y') }}</span>
                            @endif
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $target->name }}</h3>
                        @if($target->description)
                            <p class="text-sm text-gray-500 mb-4">{{ Str::limit($target->description, 100) }}</p>
                        @endif
                        <div class="mb-2">
                            <div class="flex items-center justify-between text-sm mb-1">
                                <span class="text-gray-500">Terkumpul</span>
                                <span class="font-semibold text-emerald-600">{{ $target->progress_percent }}%</span>
                            </div>
                            <div class="bg-gray-200 rounded-full h-3 overflow-hidden">
                                <div class="bg-emerald-500 h-3 rounded-full transition-all duration-500" style="width: {{ $target->progress_percent }}%"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600 font-semibold">Rp {{ number_format($target->current_amount, 0, ',', '.') }}</span>
                            <span class="text-gray-400">dari Rp {{ number_format($target->target_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Financial Dashboard --}}
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Laporan Bulanan</h2>
            <livewire:financial-dashboard :is-public="true" />
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-12 bg-emerald-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Ingin Berdonasi?</h2>
            <p class="text-gray-600 mb-6">Salurkan zakat, infaq, sedekah, dan wakaf Anda melalui QRIS atau transfer bank.</p>
            <a href="{{ route('keuangan.donasi') }}"
                class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white text-sm font-semibold rounded-lg hover:bg-emerald-700 transition shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                Donasi Sekarang
            </a>
        </div>
    </section>
</x-public-layout>
