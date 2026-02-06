<x-public-layout>
    <x-slot name="title">Layanan Nikah</x-slot>

    {{-- Hero Section --}}
    <section class="bg-emerald-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-3">Layanan Nikah</h1>
            <p class="text-emerald-100 text-lg max-w-2xl mx-auto">Informasi pendaftaran dan pelaksanaan akad nikah di Masjid Bukit Palma</p>
        </div>
    </section>

    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Info Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Persyaratan Dokumen</h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start"><span class="text-emerald-500 mr-2 mt-0.5">&#10003;</span> KTP calon pengantin (asli & fotokopi)</li>
                    <li class="flex items-start"><span class="text-emerald-500 mr-2 mt-0.5">&#10003;</span> Kartu Keluarga (asli & fotokopi)</li>
                    <li class="flex items-start"><span class="text-emerald-500 mr-2 mt-0.5">&#10003;</span> Akta Kelahiran (fotokopi)</li>
                    <li class="flex items-start"><span class="text-emerald-500 mr-2 mt-0.5">&#10003;</span> Surat pengantar dari RT/RW</li>
                    <li class="flex items-start"><span class="text-emerald-500 mr-2 mt-0.5">&#10003;</span> Surat rekomendasi dari KUA</li>
                    <li class="flex items-start"><span class="text-emerald-500 mr-2 mt-0.5">&#10003;</span> Pas foto 2x3 dan 3x4 (masing-masing 3 lembar)</li>
                    <li class="flex items-start"><span class="text-emerald-500 mr-2 mt-0.5">&#10003;</span> Surat izin orang tua (jika diperlukan)</li>
                </ul>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Prosedur Pendaftaran</h3>
                <ol class="space-y-2 text-sm text-gray-600 list-decimal list-inside">
                    <li>Hubungi sekretariat masjid via WhatsApp</li>
                    <li>Lengkapi persyaratan dokumen</li>
                    <li>Konsultasi dengan penghulu masjid</li>
                    <li>Tentukan tanggal dan waktu pelaksanaan</li>
                    <li>Pembayaran administrasi</li>
                    <li>Pelaksanaan akad nikah</li>
                </ol>
            </div>
        </div>

        {{-- Additional Info --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Tambahan</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                <div class="bg-gray-50 rounded-lg p-4 text-center">
                    <p class="text-gray-500 mb-1">Hari Pelaksanaan</p>
                    <p class="font-semibold text-gray-900">Senin - Sabtu</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4 text-center">
                    <p class="text-gray-500 mb-1">Waktu Pelaksanaan</p>
                    <p class="font-semibold text-gray-900">Ba'da Dzuhur / Ashar</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4 text-center">
                    <p class="text-gray-500 mb-1">Kapasitas Masjid</p>
                    <p class="font-semibold text-gray-900">&plusmn; 500 Jamaah</p>
                </div>
            </div>
        </div>

        {{-- CTA --}}
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-8 text-center">
            <h3 class="text-xl font-bold text-emerald-900 mb-2">Tertarik Melangsungkan Akad Nikah di Masjid Bukit Palma?</h3>
            <p class="text-emerald-700 mb-6">Silakan hubungi sekretariat masjid melalui WhatsApp untuk informasi lebih lanjut dan pendaftaran.</p>
            <a href="https://wa.me/6281234567800?text={{ urlencode('Assalamualaikum, saya ingin bertanya tentang layanan nikah di Masjid Bukit Palma.') }}" target="_blank"
                class="inline-flex items-center px-6 py-3 bg-green-500 text-white text-sm font-medium rounded-lg hover:bg-green-600 transition shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                Hubungi via WhatsApp
            </a>
        </div>
    </section>
</x-public-layout>
