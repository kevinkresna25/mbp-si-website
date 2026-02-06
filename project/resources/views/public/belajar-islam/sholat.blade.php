<x-public-layout>
    <x-slot name="title">Panduan Sholat - Belajar Islam</x-slot>

    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-emerald-700 via-emerald-800 to-emerald-900 text-white py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center px-4 py-1.5 bg-emerald-600/50 rounded-full text-sm text-emerald-100 mb-6">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Belajar Islam
            </div>
            <h1 class="text-3xl md:text-5xl font-bold mb-4">Panduan Sholat</h1>
            <p class="text-emerald-100 text-lg max-w-2xl mx-auto leading-relaxed">
                Langkah demi langkah tata cara sholat yang benar disertai bacaan Arab, transliterasi Latin, dan artinya dalam Bahasa Indonesia.
            </p>
        </div>
    </section>

    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Introduction --}}
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-5 mb-10">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-emerald-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div>
                    <p class="text-sm font-semibold text-emerald-800 mb-1">Catatan Penting</p>
                    <p class="text-sm text-emerald-700">Panduan ini menampilkan tata cara sholat fardhu secara umum. Untuk sholat yang berbeda jumlah rakaatnya, sesuaikan niat dan jumlah rakaat. Dianjurkan untuk belajar langsung dengan ustadz atau guru mengaji.</p>
                </div>
            </div>
        </div>

        {{-- Steps --}}
        <div class="space-y-6">
            @foreach($steps as $step)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden" id="step-{{ $step['no'] }}">
                {{-- Step Header --}}
                <div class="flex items-center px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <span class="flex items-center justify-center w-10 h-10 rounded-full bg-emerald-600 text-white font-bold text-lg flex-shrink-0">
                        {{ $step['no'] }}
                    </span>
                    <h3 class="ml-4 text-lg font-bold text-gray-900">{{ $step['nama'] }}</h3>
                </div>

                <div class="p-6 space-y-5">
                    {{-- Arabic Text --}}
                    <div class="bg-gray-50 rounded-xl p-5 text-center">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Bacaan Arab</p>
                        <p class="font-arabic text-2xl md:text-3xl leading-[2] text-gray-900 whitespace-pre-line" dir="rtl">{{ $step['arabic'] }}</p>
                    </div>

                    {{-- Latin Transliteration --}}
                    <div class="bg-emerald-50 rounded-xl p-5">
                        <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mb-2">Transliterasi Latin</p>
                        <p class="text-base md:text-lg text-emerald-900 italic leading-relaxed">{{ $step['latin'] }}</p>
                    </div>

                    {{-- Indonesian Meaning --}}
                    <div class="bg-amber-50 rounded-xl p-5">
                        <p class="text-xs font-semibold text-amber-600 uppercase tracking-wider mb-2">Arti</p>
                        <p class="text-base text-amber-900 leading-relaxed">{{ $step['arti'] }}</p>
                    </div>

                    {{-- Notes --}}
                    @if(!empty($step['catatan']))
                    <div class="flex items-start space-x-3 text-sm text-gray-600">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p>{{ $step['catatan'] }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{-- Quick Navigation --}}
        <div class="mt-10 bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-bold text-gray-900 mb-4">Navigasi Cepat</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($steps as $step)
                <a href="#step-{{ $step['no'] }}" class="inline-flex items-center px-3 py-1.5 bg-emerald-50 text-emerald-700 text-sm rounded-lg hover:bg-emerald-100 transition">
                    <span class="font-semibold mr-1.5">{{ $step['no'] }}.</span>
                    {{ $step['nama'] }}
                </a>
                @endforeach
            </div>
        </div>

        {{-- Video Tutorial --}}
        <div class="mt-10 bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Video Tutorial Sholat</h2>
            <p class="text-gray-600 mb-6">Lihat panduan visual tata cara sholat yang benar melalui video berikut:</p>
            <div class="aspect-video rounded-xl overflow-hidden bg-gray-100">
                <iframe
                    class="w-full h-full"
                    src="https://www.youtube.com/embed/T4auGhmeBlw"
                    title="Tutorial Tata Cara Sholat yang Benar"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    loading="lazy"
                ></iframe>
            </div>
            <p class="text-xs text-gray-400 mt-3 text-center">Video tutorial sholat dari sumber terpercaya</p>
        </div>

        {{-- Navigation --}}
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-8">
            <a href="{{ route('belajar-islam.syahadat') }}" class="inline-flex items-center text-gray-600 hover:text-emerald-600 transition text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali: Syahadat
            </a>
            <a href="{{ route('belajar-islam.mengaji') }}" class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700 transition text-sm">
                Lanjut: Kelas Mengaji
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </section>
</x-public-layout>
