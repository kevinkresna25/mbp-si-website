<x-public-layout>
    <x-slot name="title">Struktur Organisasi</x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        {{-- Breadcrumb --}}
        <nav class="flex mb-8 text-sm text-gray-500 dark:text-gray-400">
            <a wire:navigate href="/" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-gray-700 dark:text-gray-300">Profil</span>
            <span class="mx-2">/</span>
            <span class="font-semibold text-emerald-600 dark:text-emerald-400">Struktur Organisasi</span>
        </nav>

        <x-bento.grid>
             {{-- Hero Title (Full Width) --}}
            <x-bento.item span="3" class="bg-gradient-to-br from-emerald-800 to-emerald-950 text-white !border-0 min-h-[240px] flex flex-col justify-center relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')]"></div>
                <div class="absolute right-0 top-0 w-64 h-64 bg-emerald-500 rounded-full blur-3xl opacity-20 -mr-16 -mt-16"></div>
                
                <div class="relative z-10 max-w-3xl">
                    <span class="inline-block py-1 px-3 rounded-full bg-emerald-700/50 border border-emerald-600/50 text-emerald-100 text-xs font-medium mb-4 backdrop-blur-sm">
                        Khadimul Ummah
                    </span>
                    <h1 class="text-3xl md:text-5xl font-bold tracking-tight mb-4">Struktur Organisasi</h1>
                    <p class="text-emerald-200 text-lg max-w-2xl">Mengenal para pengurus dan takmir yang berkhidmat untuk memakmurkan Masjid Bukit Palma.</p>
                </div>
            </x-bento.item>

            {{-- Main Content --}}
            <x-bento.item span="2">
                @if(isset($struktur) && $struktur->isNotEmpty())
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($struktur as $anggota)
                        <div class="bg-gray-50 dark:bg-slate-700/50 rounded-2xl overflow-hidden border border-gray-100 dark:border-white/5 hover:border-emerald-500/30 transition group shadow-sm hover:shadow-md">
                            <div class="aspect-[4/5] bg-gray-200 dark:bg-slate-600 relative overflow-hidden">
                                @if($anggota->foto)
                                    <img src="{{ asset('storage/' . $anggota->foto) }}" alt="{{ $anggota->nama }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-emerald-100 dark:bg-emerald-900/30">
                                        <svg class="w-20 h-20 text-emerald-300 dark:text-emerald-700" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                    </div>
                                @endif
                                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/90 via-black/60 to-transparent p-4">
                                     <p class="text-white font-bold truncate text-lg">{{ $anggota->nama }}</p>
                                     <p class="text-emerald-300 text-xs font-bold uppercase tracking-wider">{{ $anggota->jabatan }}</p>
                                </div>
                            </div>
                            @if($anggota->kontak)
                            <div class="p-3 border-t border-gray-100 dark:border-white/5 flex items-center justify-center gap-2 text-sm text-gray-500 dark:text-gray-400 bg-white dark:bg-slate-800/50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                {{ $anggota->kontak }}
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                         <div class="w-16 h-16 bg-gray-100 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400">Data struktur organisasi belum tersedia.</p>
                    </div>
                @endif
            </x-bento.item>

            {{-- Sidebar --}}
            <div class="space-y-6 flex flex-col gap-6">
                <x-profil-sidebar />
                
                {{-- Join CTA --}}
                <x-bento.item class="bg-gradient-to-br from-emerald-600 to-teal-700 text-white !border-0 text-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-white/5 opacity-20 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
                    <div class="relative z-10">
                        <h3 class="font-bold text-lg mb-2">Ingin Bergabung?</h3>
                        <p class="text-sm text-emerald-100 mb-4 leading-relaxed">Kami membuka kesempatan bagi jamaah yang ingin menjadi relawan masjid.</p>
                        <a wire:navigate href="/kontak" class="inline-block px-4 py-2 bg-white text-emerald-700 rounded-lg text-sm font-bold hover:bg-emerald-50 transition shadow-lg shadow-black/10">Hubungi Kami</a>
                    </div>
                </x-bento.item>
            </div>
        </x-bento.grid>
    </div>
</x-public-layout>
