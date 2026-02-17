<x-public-layout>
    <x-page-header title="Keuangan & Donasi" subtitle="Laporan keuangan terbuka untuk seluruh jamaah. ZISWAF dikelola secara amanah dan transparan." breadcrumb="Keuangan" />

    {{-- Balance Overview --}}
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 text-center flex items-center justify-center gap-2">
                <span class="w-8 h-1 bg-emerald-500 rounded-full"></span>
                Saldo Per Kategori ZISWAF
                <span class="w-8 h-1 bg-emerald-500 rounded-full"></span>
            </h2>

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
                    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-gray-100 dark:border-white/5 overflow-hidden hover:shadow-lg hover:scale-[1.02] transition duration-300 group">
                        <div class="bg-gradient-to-r {{ $bgColors[$cat['category']] ?? 'from-gray-500 to-gray-600' }} p-6 relative overflow-hidden">
                             <div class="absolute right-0 top-0 w-24 h-24 bg-white opacity-10 rounded-full blur-2xl -mr-8 -mt-8"></div>
                            <div class="flex items-center space-x-4 relative z-10">
                                <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center border border-white/20 shadow-sm">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $icons[$cat['category']] ?? '' !!}</svg>
                                </div>
                                <h3 class="text-xl font-bold text-white tracking-wide capitalize">{{ $cat['label'] }}</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-3xl font-black text-gray-900 dark:text-white mb-6">Rp {{ number_format($cat['balance'], 0, ',', '.') }}</p>
                            <div class="flex items-center justify-between text-sm py-3 border-t border-gray-100 dark:border-white/5">
                                <div class="flex flex-col">
                                     <span class="text-gray-500 dark:text-gray-400 text-[10px] uppercase tracking-wider font-bold mb-1">Pemasukan</span>
                                     <span class="text-emerald-600 dark:text-emerald-400 font-bold flex items-center gap-1">
                                         <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                         Rp {{ number_format($cat['debit'], 0, ',', '.') }}
                                     </span>
                                </div>
                                <div class="flex flex-col text-right">
                                     <span class="text-gray-500 dark:text-gray-400 text-[10px] uppercase tracking-wider font-bold mb-1">Pengeluaran</span>
                                    <span class="text-rose-500 dark:text-rose-400 font-bold flex items-center justify-end gap-1">
                                        Rp {{ number_format($cat['credit'], 0, ',', '.') }}
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Total --}}
            <div class="bg-gradient-to-br from-emerald-800 to-emerald-950 text-white rounded-3xl shadow-xl p-8 md:p-12 text-center relative overflow-hidden border border-emerald-700/50">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')] opacity-10"></div>
                <div class="absolute -top-24 -left-24 w-64 h-64 bg-emerald-500 rounded-full blur-3xl opacity-20"></div>
                <div class="absolute bottom-0 right-0 w-64 h-64 bg-teal-500 rounded-full blur-3xl opacity-20"></div>
                
                <div class="relative z-10">
                    <p class="text-xs text-emerald-300 font-bold uppercase tracking-widest mb-3">Total Saldo Keseluruhan</p>
                    <p class="text-4xl md:text-6xl font-black tracking-tight mb-8 drop-shadow-sm">Rp {{ number_format($balances['total_balance'], 0, ',', '.') }}</p>
                    
                    <div class="inline-flex flex-col sm:flex-row bg-white/10 backdrop-blur-md rounded-2xl p-2 border border-white/10 shadow-lg">
                        <div class="px-8 py-4 border-b sm:border-b-0 sm:border-r border-white/10">
                            <p class="text-emerald-200 text-[10px] uppercase tracking-wider font-bold mb-1">Total Pemasukan</p>
                            <p class="text-white font-bold text-xl">Rp {{ number_format($balances['total_debit'], 0, ',', '.') }}</p>
                        </div>
                        <div class="px-8 py-4">
                             <p class="text-emerald-200 text-[10px] uppercase tracking-wider font-bold mb-1">Total Pengeluaran</p>
                            <p class="text-white font-bold text-xl">Rp {{ number_format($balances['total_credit'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Donation Targets --}}
    @if($donationTargets->count() > 0)
    <section class="py-12 bg-gray-50 dark:bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 text-center flex items-center justify-center gap-2">
                <span class="w-8 h-1 bg-emerald-500 rounded-full"></span>
                Program Donasi Aktif
                <span class="w-8 h-1 bg-emerald-500 rounded-full"></span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($donationTargets as $target)
                    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-gray-100 dark:border-white/5 p-6 hover:shadow-xl hover:-translate-y-1 transition duration-300 group flex flex-col h-full">
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-400">
                                {{ $target->category_ziswaf->label() }}
                            </span>
                            @if($target->end_date)
                                <span class="text-xs font-medium text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-slate-700/50 px-2 py-1 rounded-lg border border-gray-200 dark:border-white/5">
                                    s.d. {{ $target->end_date->format('d M Y') }}
                                </span>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-emerald-600 transition">{{ $target->name }}</h3>
                        @if($target->description)
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-6 line-clamp-2 leading-relaxed flex-grow">{{ Str::limit($target->description, 100) }}</p>
                        @endif
                        
                        <div class="mt-auto">
                            <div class="mb-6 p-5 bg-gray-50 dark:bg-slate-700/30 rounded-2xl border border-gray-100 dark:border-white/5">
                                <div class="flex items-center justify-between text-sm mb-2">
                                    <span class="text-gray-500 dark:text-gray-400 font-medium text-xs uppercase tracking-wider">Terkumpul</span>
                                    <span class="font-bold text-emerald-600 dark:text-emerald-400">{{ $target->progress_percent }}%</span>
                                </div>
                                <div class="bg-gray-200 dark:bg-slate-600 rounded-full h-2.5 overflow-hidden mb-3">
                                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-400 h-2.5 rounded-full transition-all duration-1000 ease-out shadow-[0_0_10px_rgba(16,185,129,0.5)]" style="width: {{ $target->progress_percent }}%"></div>
                                </div>
                                <div class="flex items-center justify-between text-sm pt-2 border-t border-gray-200 dark:border-white/5">
                                    <span class="text-gray-900 dark:text-white font-bold">Rp {{ number_format($target->current_amount, 0, ',', '.') }}</span>
                                    <span class="text-gray-400 text-xs">Target: Rp {{ number_format($target->target_amount, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <a href="{{ route('keuangan.donasi') }}" class="block w-full text-center px-4 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition shadow-lg shadow-emerald-600/20 active:scale-95">
                                Donasi Sekarang
                            </a>
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
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 text-center flex items-center justify-center gap-2">
                <span class="w-8 h-1 bg-emerald-500 rounded-full"></span>
                Laporan Bulanan
                <span class="w-8 h-1 bg-emerald-500 rounded-full"></span>
            </h2>
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-gray-100 dark:border-white/5 p-6 md:p-8">
                <livewire:financial-dashboard :is-public="true" />
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-emerald-50 dark:bg-emerald-900/10"></div>
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')] opacity-5"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">Ingin Berdonasi?</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-10 text-lg leading-relaxed max-w-2xl mx-auto">
                Salurkan zakat, infaq, sedekah, dan wakaf Anda melalui QRIS atau transfer bank secara mudah, aman, dan transparan.
            </p>
            <a href="{{ route('keuangan.donasi') }}"
                class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white text-lg font-bold rounded-2xl hover:shadow-xl hover:scale-105 transition duration-300 shadow-lg shadow-emerald-600/30">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                Mulai Donasi
            </a>
        </div>
    </section>
</x-public-layout>
