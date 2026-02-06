<x-public-layout>
    <x-slot name="title">Donasi - ZISWAF</x-slot>

    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-emerald-700 to-emerald-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold">Salurkan Donasi Anda</h1>
            <p class="mt-3 text-lg text-emerald-200 max-w-2xl mx-auto">Pilih kategori donasi dan scan QRIS atau hubungi kami via WhatsApp.</p>
        </div>
    </section>

    <section class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- QRIS Section --}}
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-8 mb-8 text-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Donasi via QRIS</h2>
                <p class="text-gray-500 mb-6">Scan kode QRIS di bawah ini menggunakan aplikasi pembayaran Anda</p>

                <div class="bg-gray-50 rounded-xl p-8 inline-block mx-auto mb-6">
                    <div class="w-64 h-64 bg-gray-200 rounded-lg flex items-center justify-center mx-auto border-2 border-dashed border-gray-300">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                            <p class="text-sm text-gray-400">QRIS akan ditampilkan di sini</p>
                            <p class="text-xs text-gray-300 mt-1">Hubungi admin untuk menambahkan</p>
                        </div>
                    </div>
                </div>

                <p class="text-sm text-gray-500">Mendukung semua aplikasi pembayaran: GoPay, OVO, DANA, ShopeePay, LinkAja, dan lainnya</p>
            </div>

            {{-- Category Selection --}}
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-8 mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Pilih Kategori Donasi</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @php
                        $categoryInfo = [
                            ['value' => 'zakat', 'label' => 'Zakat', 'desc' => 'Harus disalurkan ke 8 golongan mustahiq', 'color' => 'blue', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                            ['value' => 'infaq', 'label' => 'Infaq', 'desc' => 'Untuk operasional dan program masjid', 'color' => 'emerald', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ['value' => 'sedekah', 'label' => 'Sedekah', 'desc' => 'Untuk program sosial dan kemanusiaan', 'color' => 'purple', 'icon' => 'M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11'],
                            ['value' => 'wakaf', 'label' => 'Wakaf', 'desc' => 'Untuk aset jangka panjang masjid', 'color' => 'amber', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                        ];
                    @endphp

                    @foreach($categoryInfo as $cat)
                        <a href="https://wa.me/6281234567890?text={{ urlencode('Assalamualaikum, saya ingin berdonasi untuk kategori ' . $cat['label'] . ' di Masjid Bukit Palma.') }}"
                            target="_blank" rel="noopener"
                            class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-{{ $cat['color'] }}-400 hover:bg-{{ $cat['color'] }}-50 transition group">
                            <div class="w-10 h-10 bg-{{ $cat['color'] }}-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-{{ $cat['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $cat['icon'] }}"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 group-hover:text-{{ $cat['color'] }}-700">{{ $cat['label'] }}</h3>
                                <p class="text-sm text-gray-500">{{ $cat['desc'] }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Bank Transfer Info --}}
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-8 mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Transfer Bank</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Bank Syariah Indonesia (BSI)</p>
                            <p class="text-lg font-bold text-gray-900 font-mono">XXXX-XXXX-XXXX</p>
                            <p class="text-sm text-gray-500">a.n. Masjid Bukit Palma</p>
                        </div>
                        <button onclick="navigator.clipboard.writeText('XXXXXXXXXXXX').then(() => alert('Nomor rekening disalin!'))"
                            class="px-3 py-1.5 bg-emerald-100 text-emerald-700 text-sm font-medium rounded-lg hover:bg-emerald-200 transition">
                            Salin
                        </button>
                    </div>
                </div>
                <p class="text-sm text-gray-400 mt-4">* Hubungi admin untuk informasi rekening yang lengkap.</p>
            </div>

            {{-- WhatsApp Confirmation --}}
            <div class="bg-emerald-50 rounded-xl border border-emerald-200 p-8 text-center">
                <h2 class="text-xl font-bold text-gray-900 mb-2">Konfirmasi Donasi</h2>
                <p class="text-gray-600 mb-6">Setelah berdonasi, silakan konfirmasi via WhatsApp agar tercatat dengan baik.</p>
                <a href="https://wa.me/6281234567890?text={{ urlencode('Assalamualaikum, saya ingin konfirmasi donasi untuk Masjid Bukit Palma.') }}"
                    target="_blank" rel="noopener"
                    class="inline-flex items-center px-6 py-3 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Konfirmasi via WhatsApp
                </a>
            </div>

            {{-- Active Donation Programs --}}
            @if($donationTargets->count() > 0)
            <div class="mt-12">
                <h2 class="text-xl font-bold text-gray-900 mb-6 text-center">Program Donasi Aktif</h2>
                <div class="space-y-4">
                    @foreach($donationTargets as $target)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-semibold text-gray-900">{{ $target->name }}</h3>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                    {{ $target->category_ziswaf->label() }}
                                </span>
                            </div>
                            @if($target->description)
                                <p class="text-sm text-gray-500 mb-3">{{ $target->description }}</p>
                            @endif
                            <div class="mb-1">
                                <div class="flex items-center justify-between text-sm mb-1">
                                    <span class="font-semibold text-emerald-600">Rp {{ number_format($target->current_amount, 0, ',', '.') }}</span>
                                    <span class="text-gray-400">Target: Rp {{ number_format($target->target_amount, 0, ',', '.') }}</span>
                                </div>
                                <div class="bg-gray-200 rounded-full h-3 overflow-hidden">
                                    <div class="bg-emerald-500 h-3 rounded-full" style="width: {{ $target->progress_percent }}%"></div>
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
