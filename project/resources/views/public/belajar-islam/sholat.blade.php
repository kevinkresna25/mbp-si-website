<x-public-layout>
    <x-page-header title="Panduan Sholat" subtitle="Tata cara sholat yang benar disertai bacaan Arab, Latin, dan artinya" breadcrumb="Belajar Islam / Sholat" />

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <x-bento.grid>
            {{-- Content --}}
            <x-bento.item span="2" class="space-y-8">
                {{-- Introduction --}}
                <div class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-500/30 rounded-2xl p-6 flex items-start gap-4">
                    <div class="p-2 bg-emerald-100 dark:bg-emerald-800 rounded-lg shrink-0 text-emerald-600 dark:text-emerald-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-emerald-900 dark:text-emerald-100 mb-1">Catatan Penting</h3>
                        <p class="text-sm text-emerald-800 dark:text-emerald-200 leading-relaxed">Panduan ini menampilkan tata cara sholat fardhu secara umum. Untuk sholat yang berbeda jumlah rakaatnya, sesuaikan niat dan jumlah rakaat. Dianjurkan untuk belajar langsung dengan ustadz atau guru mengaji.</p>
                    </div>
                </div>

                <div class="space-y-8">
                     @foreach($steps as $step)
                     <div class="bg-white dark:bg-slate-700/30 rounded-2xl border border-gray-100 dark:border-white/5 overflow-hidden scroll-mt-24" id="step-{{ $step['no'] }}">
                        <div class="bg-gray-50 dark:bg-slate-700/50 px-6 py-4 flex items-center gap-4 border-b border-gray-100 dark:border-white/5">
                             <div class="w-8 h-8 rounded-full bg-emerald-600 flex items-center justify-center text-white font-bold text-sm shadow-md">
                                 {{ $step['no'] }}
                             </div>
                             <h3 class="font-bold text-gray-900 dark:text-white text-lg">{{ $step['nama'] }}</h3>
                        </div>
                        <div class="p-6 space-y-6">
                            {{-- Arabic --}}
                            <div class="bg-gray-50 dark:bg-slate-800 rounded-xl p-6 text-center border border-gray-100 dark:border-white/5">
                                 <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">Bacaan Arab</p>
                                 <p class="font-arabic text-3xl md:text-4xl leading-[2] text-gray-900 dark:text-white whitespace-pre-line" dir="rtl">{{ $step['arabic'] }}</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {{-- Latin --}}
                                <div class="bg-emerald-50 dark:bg-emerald-900/10 rounded-xl p-5 border border-emerald-100 dark:border-emerald-500/20">
                                    <p class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider mb-2">Transliterasi Latin</p>
                                     <p class="text-lg text-emerald-900 dark:text-emerald-100 italic leading-relaxed">{{ $step['latin'] }}</p>
                                </div>
                                {{-- Meaning --}}
                                <div class="bg-amber-50 dark:bg-amber-900/10 rounded-xl p-5 border border-amber-100 dark:border-amber-500/20">
                                     <p class="text-xs font-bold text-amber-600 dark:text-amber-400 uppercase tracking-wider mb-2">Arti</p>
                                     <p class="text-amber-900 dark:text-amber-100 leading-relaxed">{{ $step['arti'] }}</p>
                                </div>
                            </div>

                             @if(!empty($step['catatan']))
                             <div class="flex items-start gap-3 p-4 bg-blue-50 dark:bg-blue-900/10 rounded-xl text-sm text-blue-900 dark:text-blue-100">
                                 <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                 <p>{{ $step['catatan'] }}</p>
                             </div>
                             @endif
                        </div>
                     </div>
                     @endforeach
                </div>
            </x-bento.item>

            {{-- Sidebar --}}
            <div class="space-y-6">
                <x-sidebar-menu title="Belajar Islam" :links="[
                    ['label' => 'Syahadat & Iman', 'url' => '/belajar-islam/syahadat', 'color' => 'bg-emerald-500'],
                    ['label' => 'Panduan Sholat', 'url' => '/belajar-islam/sholat', 'color' => 'bg-blue-500'],
                    ['label' => 'Kelas Mengaji', 'url' => '/belajar-islam/mengaji', 'color' => 'bg-purple-500'],
                ]" />

                {{-- Quick Nav --}}
                <x-bento.item>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4">Urutan Sholat</h3>
                    <div class="flex flex-wrap gap-2">
                         @foreach($steps as $step)
                         <a href="#step-{{ $step['no'] }}" class="px-3 py-1.5 bg-gray-100 dark:bg-slate-700 hover:bg-emerald-500 hover:text-white dark:hover:bg-emerald-600 text-gray-600 dark:text-gray-300 rounded-lg text-xs font-medium transition duration-300">
                             {{ $step['no'] }}. {{ Str::limit($step['nama'], 15) }}
                         </a>
                         @endforeach
                    </div>
                </x-bento.item>

                {{-- Video --}}
                <x-bento.item class="!p-0 overflow-hidden">
                    <div class="p-4 border-b border-gray-100 dark:border-white/5">
                        <h3 class="font-bold text-gray-900 dark:text-white">Video Tutorial</h3>
                    </div>
                    <div class="aspect-video bg-black">
                        <iframe
                            class="w-full h-full"
                            src="https://www.youtube.com/embed/T4auGhmeBlw"
                            title="Tutorial Sholat"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            loading="lazy"
                        ></iframe>
                    </div>
                    <div class="p-3 text-xs text-center text-gray-500 dark:text-gray-400">
                        Sumber: YouTube (External)
                    </div>
                </x-bento.item>
            </div>
        </x-bento.grid>
    </section>
</x-public-layout>
