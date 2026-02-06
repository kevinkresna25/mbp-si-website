<x-public-layout>
    <x-slot name="title">Sejarah Masjid</x-slot>

    {{-- Page Header --}}
    <section class="bg-gradient-to-br from-emerald-700 to-emerald-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm text-emerald-200 mb-4">
                <a href="/" class="hover:text-white transition">Beranda</a>
                <span class="mx-2">/</span>
                <span>Profil</span>
                <span class="mx-2">/</span>
                <span class="text-white">Sejarah</span>
            </nav>
            <h1 class="text-3xl md:text-4xl font-bold">Sejarah Masjid Bukit Palma</h1>
            <p class="text-emerald-200 mt-2">Mengenal perjalanan dan sejarah masjid kita</p>
        </div>
    </section>

    {{-- Content --}}
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($page)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ $page->title }}</h2>
            <div class="prose prose-emerald prose-lg max-w-none text-gray-600">
                {!! $page->content !!}
            </div>
            @if($page->updater)
            <div class="mt-8 pt-6 border-t border-gray-100 text-sm text-gray-400">
                Terakhir diperbarui oleh {{ $page->updater->name }} pada {{ $page->updated_at->translatedFormat('d F Y') }}
            </div>
            @endif
        </div>
        @else
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <p class="text-gray-500">Konten sejarah belum tersedia. Silakan hubungi administrator.</p>
        </div>
        @endif
    </section>
</x-public-layout>
