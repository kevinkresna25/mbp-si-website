<x-public-layout>
    <x-slot name="title">Struktur Organisasi</x-slot>
    <x-page-header :title="$page->title ?? 'Struktur Organisasi'" subtitle="Mengenal para pengurus dan takmir yang berkhidmat untuk memakmurkan Masjid Bukit Palma." breadcrumb="Profil / Struktur Organisasi" />
    
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 relative">
        {{-- Background Decoration --}}
        <div class="absolute top-20 right-0 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute bottom-20 left-0 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-8">
                @if(isset($struktur) && $struktur->isNotEmpty())
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($struktur as $anggota)
                        <div class="bg-white dark:bg-slate-800 rounded-3xl overflow-hidden border border-emerald-100 dark:border-white/5 hover:border-emerald-500/30 transition group shadow-lg shadow-gray-200/50 dark:shadow-none hover:shadow-xl duration-500">
                            <div class="aspect-[4/5] bg-gray-200 dark:bg-slate-600 relative overflow-hidden">
                                @if($anggota->foto)
                                    <img src="{{ asset('storage/' . $anggota->foto) }}" alt="{{ $anggota->nama }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-emerald-100 dark:bg-emerald-900/30">
                                        <svg class="w-20 h-20 text-emerald-300 dark:text-emerald-700" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                    </div>
                                @endif
                                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/90 via-black/60 to-transparent p-6">
                                     <p class="text-white font-bold truncate text-lg">{{ $anggota->nama }}</p>
                                     <p class="text-emerald-300 text-xs font-bold uppercase tracking-wider">{{ $anggota->jabatan }}</p>
                                </div>
                            </div>
                            @if($anggota->kontak)
                            <div class="p-4 border-t border-emerald-100 dark:border-white/5 flex items-center justify-center gap-2 text-sm text-gray-500 dark:text-gray-400 bg-white dark:bg-slate-800/50">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                {{ $anggota->kontak }}
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-white dark:bg-slate-800 rounded-3xl border border-emerald-200 dark:border-emerald-500/20 p-8 shadow-xl shadow-gray-200/50 dark:shadow-none">
                         <div class="w-16 h-16 bg-gray-100 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400">Data struktur organisasi belum tersedia.</p>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6 sticky top-24 h-fit">
                <x-profil-sidebar />
                
                {{-- Join CTA --}}
                <div class="bg-gradient-to-br from-indigo-50 to-blue-50 dark:from-indigo-900/10 dark:to-blue-900/10 border border-indigo-100 dark:border-indigo-500/20 text-center relative overflow-hidden rounded-3xl shadow-lg group p-8">
                    <div class="absolute inset-0 bg-white/40 dark:bg-slate-900/40 opacity-20 bg-[radial-gradient(#6366f1_1px,transparent_1px)] [background-size:16px_16px]"></div>
                    <div class="relative z-10">
                        <h3 class="font-bold text-lg mb-2 text-indigo-900 dark:text-indigo-100">Ingin Bergabung?</h3>
                        <p class="text-sm text-indigo-700 dark:text-indigo-300 mb-4 leading-relaxed">Kami membuka kesempatan bagi jamaah yang ingin menjadi relawan masjid.</p>
                        <a wire:navigate href="/kontak" class="inline-block px-5 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30 hover:-translate-y-1">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
