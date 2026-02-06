<x-public-layout>
    <x-slot name="title">Permohonan Fasilitas</x-slot>

    {{-- Hero Section --}}
    <section class="bg-emerald-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-3">Permohonan Fasilitas</h1>
            <p class="text-emerald-100 text-lg max-w-2xl mx-auto">Ajukan permohonan penggunaan fasilitas Masjid Bukit Palma untuk kegiatan Anda</p>
        </div>
    </section>

    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Available Facilities --}}
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Fasilitas yang Tersedia</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Aula Utama Masjid</h3>
                <p class="text-sm text-gray-600 mb-3">Ruangan utama masjid yang dapat digunakan untuk kegiatan keagamaan, pengajian, dan acara besar.</p>
                <p class="text-xs text-gray-400">Kapasitas: &plusmn; 500 orang</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2v16z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Ruang Serbaguna</h3>
                <p class="text-sm text-gray-600 mb-3">Ruang serbaguna untuk rapat, kajian kecil, kelas mengaji, dan kegiatan remaja masjid.</p>
                <p class="text-xs text-gray-400">Kapasitas: &plusmn; 50 orang</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Halaman Masjid</h3>
                <p class="text-sm text-gray-600 mb-3">Area terbuka untuk kegiatan outdoor seperti bazar, santunan, dan kegiatan sosial.</p>
                <p class="text-xs text-gray-400">Kapasitas: &plusmn; 200 orang</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Sound System & Multimedia</h3>
                <p class="text-sm text-gray-600 mb-3">Peralatan sound system, proyektor, dan layar untuk mendukung presentasi dan kajian.</p>
                <p class="text-xs text-gray-400">Termasuk mikrofon, speaker, dan proyektor</p>
            </div>
        </div>

        {{-- Procedure --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-10">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Prosedur Permohonan</h3>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="w-8 h-8 bg-emerald-600 text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0 mt-0.5">1</div>
                    <div class="ml-4">
                        <h4 class="font-medium text-gray-900">Hubungi Sekretariat</h4>
                        <p class="text-sm text-gray-600 mt-0.5">Sampaikan rencana kegiatan dan fasilitas yang dibutuhkan melalui WhatsApp.</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="w-8 h-8 bg-emerald-600 text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0 mt-0.5">2</div>
                    <div class="ml-4">
                        <h4 class="font-medium text-gray-900">Ajukan Surat Permohonan</h4>
                        <p class="text-sm text-gray-600 mt-0.5">Kirimkan surat permohonan resmi yang memuat detail kegiatan, tanggal, waktu, dan jumlah peserta.</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="w-8 h-8 bg-emerald-600 text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0 mt-0.5">3</div>
                    <div class="ml-4">
                        <h4 class="font-medium text-gray-900">Konfirmasi dari Takmir</h4>
                        <p class="text-sm text-gray-600 mt-0.5">Takmir akan meninjau permohonan dan memberikan konfirmasi ketersediaan fasilitas.</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="w-8 h-8 bg-emerald-600 text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0 mt-0.5">4</div>
                    <div class="ml-4">
                        <h4 class="font-medium text-gray-900">Pelaksanaan Kegiatan</h4>
                        <p class="text-sm text-gray-600 mt-0.5">Setelah disetujui, Anda dapat menggunakan fasilitas sesuai jadwal yang disepakati.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- CTA --}}
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-8 text-center">
            <h3 class="text-xl font-bold text-emerald-900 mb-2">Ajukan Permohonan Sekarang</h3>
            <p class="text-emerald-700 mb-6">Hubungi sekretariat masjid melalui WhatsApp untuk mengajukan permohonan penggunaan fasilitas.</p>
            <a href="https://wa.me/6281234567802?text={{ urlencode('Assalamualaikum, saya ingin mengajukan permohonan penggunaan fasilitas Masjid Bukit Palma untuk kegiatan: [sebutkan kegiatan], pada tanggal: [sebutkan tanggal].') }}" target="_blank"
                class="inline-flex items-center px-6 py-3 bg-green-500 text-white text-sm font-medium rounded-lg hover:bg-green-600 transition shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                Hubungi via WhatsApp
            </a>
        </div>
    </section>
</x-public-layout>
