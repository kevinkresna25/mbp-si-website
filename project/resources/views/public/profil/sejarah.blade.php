<x-public-layout>
    <x-slot name="title">Sejarah Masjid</x-slot>
    <style>
        .prose h1, .prose h2, .prose h3 { color: inherit; font-weight: 700; margin-top: 1.5em; margin-bottom: 0.5em; }
        .prose h2 { font-size: 1.5rem; }
        .prose h3 { font-size: 1.25rem; }
        .prose p { margin-bottom: 1em; line-height: 1.75; }
        .prose ul { list-style-type: disc; padding-left: 1.25em; margin-bottom: 1em; }
        .prose blockquote { border-left: 4px solid #10b981; padding-left: 1em; font-style: italic; }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        {{-- Breadcrumb --}}
        <nav class="flex mb-8 text-sm text-gray-500 dark:text-gray-400">
            <a wire:navigate href="/" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-gray-700 dark:text-gray-300">Profil</span>
            <span class="mx-2">/</span>
            <span class="font-semibold text-emerald-600 dark:text-emerald-400">Sejarah</span>
        </nav>

        <x-bento.grid>
            {{-- Hero Title (Full Width) --}}
            <x-bento.item span="3" class="bg-gradient-to-br from-emerald-800 to-emerald-950 text-white !border-0 min-h-[240px] flex flex-col justify-center relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')]"></div>
                <div class="absolute right-0 top-0 w-64 h-64 bg-emerald-500 rounded-full blur-3xl opacity-20 -mr-16 -mt-16"></div>
                
                <div class="relative z-10 max-w-3xl">
                    <span class="inline-block py-1 px-3 rounded-full bg-emerald-700/50 border border-emerald-600/50 text-emerald-100 text-xs font-medium mb-4 backdrop-blur-sm">
                        Profil Masjid
                    </span>
                    <h1 class="text-3xl md:text-5xl font-bold tracking-tight mb-4">Sejarah & Perjalanan Kami</h1>
                    <p class="text-emerald-200 text-lg max-w-2xl">Mengenal lebih dekat bagaimana Masjid Bukit Palma berdiri dan berkembang menjadi pusat peradaban umat.</p>
                </div>
            </x-bento.item>

            {{-- Main Content (Left - Span 2) --}}
            <x-bento.item span="2" class="min-h-[400px]">
                @if($page)
                    <div class="flex items-center gap-4 mb-6 border-b border-gray-100 dark:border-white/5 pb-6">
                        <div class="w-12 h-12 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400 font-bold text-xl">
                            {{ substr($page->title ?? 'S', 0, 1) }}
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $page->title }}</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Diperbarui {{ $page->updated_at->diffForHumans() }}
                                @if($page->updater) • oleh {{ $page->updater->name }} @endif
                            </p>
                        </div>
                    </div>

                    <div class="prose prose-emerald dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 leading-relaxed">
                        {!! $page->content !!}
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center h-full text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-slate-700 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Konten Belum Tersedia</h3>
                        <p class="text-gray-500 dark:text-gray-400 mt-2">Halaman profil ini belum diisi oleh administrator.</p>
                        <a wire:navigate href="/" class="mt-4 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">Kembali ke Beranda</a>
                    </div>
                @endif
            </x-bento.item>

            {{-- Sidebar (Right - Span 1) --}}
            <div class="space-y-6 flex flex-col gap-6">
                {{-- Quick Navigation --}}
                <x-bento.item class="!p-0 overflow-hidden">
                    <div class="bg-gray-50 dark:bg-slate-700/50 p-4 border-b border-gray-100 dark:border-white/5">
                        <h3 class="font-bold text-gray-900 dark:text-white">Menu Profil</h3>
                    </div>
                    <div class="p-2 space-y-1">
                        <a wire:navigate href="/profil/sejarah" class="flex items-center gap-3 px-3 py-3 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 font-medium">
                            <div class="w-2 h-2 rounded-full bg-emerald-500"></div> Sejarah
                        </a>
                        <a wire:navigate href="/profil/visi-misi" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                            <div class="w-2 h-2 rounded-full bg-gray-300 dark:bg-white/20"></div> Visi & Misi
                        </a>
                        <a wire:navigate href="/profil/struktur" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                            <div class="w-2 h-2 rounded-full bg-gray-300 dark:bg-white/20"></div> Struktur Organisasi
                        </a>
                        <a wire:navigate href="/profil/lokasi" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                            <div class="w-2 h-2 rounded-full bg-gray-300 dark:bg-white/20"></div> Lokasi
                        </a>
                    </div>
                </x-bento.item>

                {{-- Quote / Hadith --}}
                <x-bento.item class="bg-gradient-to-br from-gold-400 to-gold-600 text-white !border-0">
                    <svg class="w-8 h-8 text-gold-200 mb-4 opacity-70" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.0547 15.1953 15.1094 17.5508 15.1641C18.6758 15.1914 19.332 15.6562 19.5195 16.5586L19.7812 16.4883C19.7148 15.4258 19.4648 14.5078 19.0312 13.7344C18.1758 12.1836 16.5938 11.4531 14.2812 11.543L14.0177 11.2383C14.0527 10.3711 14.375 9.48828 14.9844 8.58984C15.6094 7.64453 16.4883 6.94531 17.6211 6.49219L17.75 6.77344C16.9062 7.15234 16.332 7.64453 16.0273 8.24609C15.7227 8.84766 15.5859 9.54297 15.6172 10.332C16.5195 10.2266 17.2969 10.457 17.9492 11.0234C18.6016 11.5898 18.9219 12.3516 18.9062 13.3086C18.8828 14.2422 18.5273 15.0195 17.8438 15.6406C17.1602 16.2617 16.3164 16.5586 15.3125 16.5352C14.7383 16.5234 14.3047 16.332 14.0156 15.9609L14.017 21ZM14.017 21L14.017 21ZM5.52344 21L5.52344 18C5.52344 16.0547 6.70312 15.1094 9.0625 15.1641C10.1875 15.1914 10.8438 15.6562 11.0312 16.5586L11.293 16.4883C11.2266 15.4258 10.9766 14.5078 10.543 13.7344C9.69141 12.1836 8.10938 11.4531 5.79688 11.543L5.52344 11.2383C5.55859 10.3711 5.88281 9.48828 6.49219 8.58984C7.11719 7.64453 8.00391 6.94531 9.13672 6.49219L9.26172 6.77344C8.42188 7.15234 7.84766 7.64453 7.54297 8.24609C7.23828 8.84766 7.10156 9.54297 7.13281 10.332C8.03516 10.2266 8.8125 10.457 9.46484 11.0234C10.1172 11.5898 10.4375 12.3516 10.4219 13.3086C10.3984 14.2422 10.043 15.0195 9.35547 15.6406C8.67578 16.2617 7.83203 16.5586 6.82422 16.5352C6.25 16.5234 5.81641 16.332 5.52734 15.9609L5.52344 21Z"/></svg>
                    <p class="font-medium text-lg leading-relaxed italic mb-4">"Siapa yang membangun masjid karena Allah, maka Allah akan membangunkan baginya semisélné di surga."</p>
                    <p class="text-xs font-bold uppercase tracking-widest text-gold-100/80">(HR. Bukhari & Muslim)</p>
                </x-bento.item>
            </div>
        </x-bento.grid>
    </div>
</x-public-layout>
