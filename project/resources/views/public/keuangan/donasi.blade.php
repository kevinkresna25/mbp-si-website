<x-public-layout>
    <x-page-header title="Salurkan Donasi" subtitle="Pilih kategori donasi dan scan QRIS atau hubungi kami via WhatsApp." breadcrumb="Donasi" />

    <section class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- QRIS Section --}}
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-gray-100 dark:border-white/5 p-8 mb-8 text-center relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-emerald-400 to-teal-500"></div>
                
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Donasi via QRIS</h2>
                <p class="text-gray-500 dark:text-gray-400 mb-8">Scan kode QRIS di bawah ini menggunakan aplikasi pembayaran Anda</p>

                <div class="bg-gray-50 dark:bg-slate-900/50 rounded-2xl p-8 inline-block mx-auto mb-6 border border-gray-200 dark:border-white/5 shadow-inner">
                    <div class="w-64 h-64 bg-white dark:bg-slate-700/50 rounded-xl flex items-center justify-center mx-auto border-2 border-dashed border-gray-300 dark:border-white/10 relative group-hover:border-emerald-500/50 transition">
                        <div class="text-center p-6">
                            <svg class="w-16 h-16 text-gray-400 dark:text-gray-500 mx-auto mb-3 group-hover:text-emerald-500 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">QRIS akan ditampilkan di sini</p>
                            <p class="text-[10px] text-gray-400 dark:text-gray-500 mt-2 uppercase tracking-wide">Hubungi admin untuk menambahkan</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap justify-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                    <span class="px-3 py-1 bg-gray-100 dark:bg-slate-700 rounded-full">GoPay</span>
                    <span class="px-3 py-1 bg-gray-100 dark:bg-slate-700 rounded-full">OVO</span>
                    <span class="px-3 py-1 bg-gray-100 dark:bg-slate-700 rounded-full">DANA</span>
                    <span class="px-3 py-1 bg-gray-100 dark:bg-slate-700 rounded-full">LinkAja</span>
                    <span class="px-3 py-1 bg-gray-100 dark:bg-slate-700 rounded-full">ShopeePay</span>
                    <span class="px-3 py-1 bg-gray-100 dark:bg-slate-700 rounded-full">BSI Mobile</span>
                </div>
            </div>

            {{-- Category Selection --}}
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-gray-100 dark:border-white/5 p-8 mb-8">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    Pilih Kategori Donasi
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @php
                        $categoryInfo = [
                            ['value' => 'zakat', 'label' => 'Zakat', 'desc' => 'Disalurkan ke 8 asnaf', 'color' => 'blue', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                            ['value' => 'infaq', 'label' => 'Infaq', 'desc' => 'Operasional masjid', 'color' => 'emerald', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ['value' => 'sedekah', 'label' => 'Sedekah', 'desc' => 'Sosial & kemanusiaan', 'color' => 'purple', 'icon' => 'M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11'],
                            ['value' => 'wakaf', 'label' => 'Wakaf', 'desc' => 'Aset jangka panjang', 'color' => 'amber', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                        ];
                    @endphp

                    @foreach($categoryInfo as $cat)
                        <a href="https://wa.me/6281234567890?text={{ urlencode('Assalamualaikum, saya ingin berdonasi untuk kategori ' . $cat['label'] . ' di Masjid Bukit Palma.') }}"
                            target="_blank" rel="noopener"
                            class="flex items-start space-x-4 p-4 rounded-2xl border border-gray-100 dark:border-slate-700 bg-gray-50 dark:bg-slate-700/30 hover:bg-{{ $cat['color'] }}-50 dark:hover:bg-{{ $cat['color'] }}-900/20 hover:border-{{ $cat['color'] }}-200 dark:hover:border-{{ $cat['color'] }}-500/30 transition duration-300 group">
                            <div class="w-10 h-10 bg-{{ $cat['color'] }}-100 dark:bg-{{ $cat['color'] }}-900/50 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition duration-300">
                                <svg class="w-5 h-5 text-{{ $cat['color'] }}-600 dark:text-{{ $cat['color'] }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $cat['icon'] }}"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 dark:text-white group-hover:text-{{ $cat['color'] }}-700 dark:group-hover:text-{{ $cat['color'] }}-400">{{ $cat['label'] }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">{{ $cat['desc'] }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Bank Transfer Info --}}
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-gray-100 dark:border-white/5 p-8 mb-8">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                    Transfer Bank
                </h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-5 bg-gray-50 dark:bg-slate-700/30 rounded-2xl border border-gray-100 dark:border-white/5">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Bank Syariah Indonesia (BSI)</p>
                            <p class="text-xl font-bold text-gray-900 dark:text-white font-mono tracking-tight mt-1">XXXX-XXXX-XXXX</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">a.n. Masjid Bukit Palma</p>
                        </div>
                        <button onclick="navigator.clipboard.writeText('XXXXXXXXXXXX').then(() => alert('Nomor rekening disalin!'))"
                            class="px-4 py-2 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-sm font-bold rounded-xl hover:bg-emerald-200 dark:hover:bg-emerald-900/50 transition active:scale-95">
                            Salin
                        </button>
                    </div>
                </div>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-4 italic">* Hubungi admin untuk informasi rekening yang lengkap atau konfirmasi.</p>
            </div>

            {{-- WhatsApp Confirmation --}}
            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-3xl border border-emerald-100 dark:border-emerald-500/10 p-8 text-center">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Sudah Transfer?</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-8 max-w-lg mx-auto">Mohon konfirmasi donasi Anda via WhatsApp agar kami dapat mencatat dan menyalurkan amanah Anda dengan tepat.</p>
                <a href="https://wa.me/6281234567890?text={{ urlencode('Assalamualaikum, saya ingin konfirmasi donasi untuk Masjid Bukit Palma.') }}"
                    target="_blank" rel="noopener"
                    class="inline-flex items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition shadow-lg shadow-emerald-500/20 hover:scale-105 active:scale-95">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Konfirmasi WhatsApp
                </a>
            </div>

            {{-- Active Donation Programs --}}
            @if($donationTargets->count() > 0)
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 text-center flex items-center justify-center gap-2">
                    <span class="w-8 h-1 bg-emerald-500 rounded-full"></span>
                    Program Donasi Aktif
                    <span class="w-8 h-1 bg-emerald-500 rounded-full"></span>
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($donationTargets as $target)
                        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-white/5 p-6 hover:shadow-lg transition">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="font-bold text-gray-900 dark:text-white text-lg">{{ $target->name }}</h3>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-400 uppercase tracking-wide">
                                    {{ $target->category_ziswaf->label() }}
                                </span>
                            </div>
                            @if($target->description)
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 line-clamp-2">{{ $target->description }}</p>
                            @endif
                            <div class="space-y-2">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($target->current_amount, 0, ',', '.') }}</span>
                                    <span class="text-gray-400 dark:text-gray-500 text-xs">Target: Rp {{ number_format($target->target_amount, 0, ',', '.') }}</span>
                                </div>
                                <div class="bg-gray-100 dark:bg-slate-700 rounded-full h-2.5 overflow-hidden">
                                    <div class="bg-emerald-500 h-2.5 rounded-full shadow-[0_0_8px_rgba(16,185,129,0.4)]" style="width: {{ $target->progress_percent }}%"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>
</x-public-layout>
