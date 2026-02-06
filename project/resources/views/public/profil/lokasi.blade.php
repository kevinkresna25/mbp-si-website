<x-public-layout>
    <x-slot name="title">Lokasi Masjid</x-slot>

    {{-- Page Header --}}
    <section class="bg-gradient-to-br from-emerald-700 to-emerald-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm text-emerald-200 mb-4">
                <a href="/" class="hover:text-white transition">Beranda</a>
                <span class="mx-2">/</span>
                <span>Profil</span>
                <span class="mx-2">/</span>
                <span class="text-white">Lokasi</span>
            </nav>
            <h1 class="text-3xl md:text-4xl font-bold">Lokasi Masjid</h1>
            <p class="text-emerald-200 mt-2">Temukan kami di Perumahan Bukit Palma, Surabaya</p>
        </div>
    </section>

    {{-- Content --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid md:grid-cols-2 gap-8">
            {{-- Map --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="aspect-video">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5!2d112.7!3d-7.3!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sMasjid+Bukit+Palma!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        class="w-full h-full"
                    ></iframe>
                </div>
            </div>

            {{-- Info --}}
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Alamat
                    </h3>
                    <p class="text-gray-600">
                        Masjid Bukit Palma<br>
                        Perumahan Bukit Palma<br>
                        Surabaya, Jawa Timur<br>
                        Indonesia
                    </p>
                </div>

                @if($page && $page->content)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Informasi Tambahan
                    </h3>
                    <div class="prose prose-emerald text-gray-600">
                        {!! $page->content !!}
                    </div>
                </div>
                @endif

                <div class="bg-emerald-50 rounded-2xl p-6 border border-emerald-100">
                    <h3 class="text-lg font-bold text-emerald-800 mb-3">Jam Operasional Sekretariat</h3>
                    <div class="space-y-2 text-sm text-emerald-700">
                        <div class="flex justify-between">
                            <span>Senin - Jumat</span>
                            <span class="font-medium">08:00 - 17:00 WIB</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Sabtu - Minggu</span>
                            <span class="font-medium">09:00 - 12:00 WIB</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
