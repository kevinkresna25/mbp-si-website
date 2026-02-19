<x-public-layout>
    <x-page-header title="Panduan Sholat" subtitle="Tata cara sholat yang benar disertai bacaan Arab, Latin, dan artinya" breadcrumb="Belajar Islam / Sholat" />

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 relative">
        {{-- Background Decoration --}}
        <div class="absolute top-40 left-0 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute bottom-40 right-0 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
             {{-- Content --}}
             <div class="lg:col-span-2 space-y-8">
                 {{-- Introduction --}}
                <div class="bg-gradient-to-br from-emerald-50 to-white dark:from-emerald-900/20 dark:to-slate-800 border border-emerald-100 dark:border-emerald-500/20 rounded-3xl p-6 flex items-start gap-4 shadow-sm relative overflow-hidden">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')] opacity-5 pointer-events-none"></div>
                    <div class="p-3 bg-emerald-100 dark:bg-emerald-800/50 rounded-2xl shrink-0 text-emerald-600 dark:text-emerald-300 shadow-inner">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="relative z-10">
                        <h3 class="font-bold text-emerald-900 dark:text-emerald-100 mb-2 text-lg">Catatan Penting</h3>
                        <p class="text-emerald-800 dark:text-emerald-200 leading-relaxed text-sm">Panduan ini menampilkan tata cara sholat fardhu secara umum. Untuk sholat yang berbeda jumlah rakaatnya, sesuaikan niat dan jumlah rakaat. Dianjurkan untuk belajar langsung dengan ustadz atau guru mengaji.</p>
                    </div>
                </div>

                <div class="space-y-8">
                     @foreach($steps as $step)
                     <div class="bg-white dark:bg-slate-800 rounded-3xl border border-emerald-200 dark:border-emerald-500/20 overflow-hidden scroll-mt-32 shadow-xl shadow-gray-200/50 dark:shadow-none hover:shadow-2xl transition duration-500 group" id="step-{{ $step['no'] }}">
                        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-4 flex items-center gap-4 relative overflow-hidden">
                             <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')] opacity-10 pointer-events-none"></div>
                             <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center text-white font-bold text-lg shadow-inner border border-white/10 group-hover:scale-110 transition duration-300">
                                 {{ $step['no'] }}
                             </div>
                             <h3 class="font-bold text-white text-xl tracking-tight relative z-10">{{ $step['nama'] }}</h3>
                        </div>
                        <div class="p-8 space-y-8">
                            {{-- Arabic --}}
                            <div class="bg-white dark:bg-slate-700/30 rounded-2xl p-8 text-center border border-emerald-200 dark:border-emerald-500/20 shadow-sm relative overflow-hidden group-hover:border-emerald-500/30 transition duration-500">
                                 <div class="absolute inset-0 bg-emerald-500/5 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                                 <p class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider mb-6 relative z-10">Bacaan Arab</p>
                                 <p class="font-arabic text-4xl md:text-5xl leading-[2.2] text-gray-900 dark:text-white whitespace-pre-line relative z-10 drop-shadow-sm" dir="rtl">{{ $step['arabic'] }}</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Latin --}}
                                <div class="bg-emerald-50/50 dark:bg-emerald-900/10 rounded-2xl p-6 border border-emerald-100 dark:border-emerald-500/20">
                                    <p class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider mb-3">Transliterasi Latin</p>
                                     <p class="text-lg text-emerald-900 dark:text-emerald-100 italic leading-relaxed font-serif">{{ $step['latin'] }}</p>
                                </div>
                                {{-- Meaning --}}
                                <div class="bg-amber-50/50 dark:bg-amber-900/10 rounded-2xl p-6 border border-amber-100 dark:border-amber-500/20">
                                     <p class="text-xs font-bold text-amber-600 dark:text-amber-400 uppercase tracking-wider mb-3">Arti</p>
                                     <p class="text-amber-900 dark:text-amber-100 leading-relaxed">{{ $step['arti'] }}</p>
                                </div>
                            </div>

                             @if(!empty($step['catatan']))
                             <div class="flex items-start gap-4 p-5 bg-blue-50/50 dark:bg-blue-900/10 rounded-2xl text-sm text-blue-900 dark:text-blue-100 border border-blue-100 dark:border-blue-500/20">
                                 <svg class="w-5 h-5 shrink-0 mt-0.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                 <p class="leading-relaxed">{{ $step['catatan'] }}</p>
                             </div>
                             @endif
                        </div>
                     </div>
                     @endforeach
                </div>
             </div>

             {{-- Sidebar --}}
             <div class="space-y-8">
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-lg shadow-gray-200/50 dark:shadow-none border border-emerald-200 dark:border-emerald-500/20 sticky top-24">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                         <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        Belajar Islam
                    </h3>
                    <nav class="space-y-2">
                        <a href="{{ route('belajar-islam.syahadat') }}" 
                            class="flex items-center justify-between p-4 rounded-xl transition-all duration-300 {{ request()->routeIs('belajar-islam.syahadat') ? 'bg-emerald-500 text-white shadow-emerald-500/30 shadow-lg' : 'bg-gray-50 dark:bg-slate-700/30 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-slate-700 hover:text-emerald-600 dark:hover:text-emerald-400' }}">
                            <span class="font-bold text-sm">Syahadat & Iman</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </a>
                        <a href="{{ route('belajar-islam.sholat') }}"
                            class="flex items-center justify-between p-4 rounded-xl transition-all duration-300 {{ request()->routeIs('belajar-islam.sholat') ? 'bg-emerald-500 text-white shadow-emerald-500/30 shadow-lg' : 'bg-gray-50 dark:bg-slate-700/30 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-slate-700 hover:text-emerald-600 dark:hover:text-emerald-400' }}">
                            <span class="font-bold text-sm">Panduan Sholat</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </a>
                        <a href="{{ route('belajar-islam.mengaji') }}"
                            class="flex items-center justify-between p-4 rounded-xl transition-all duration-300 {{ request()->routeIs('belajar-islam.mengaji') ? 'bg-emerald-500 text-white shadow-emerald-500/30 shadow-lg' : 'bg-gray-50 dark:bg-slate-700/30 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-slate-700 hover:text-emerald-600 dark:hover:text-emerald-400' }}">
                            <span class="font-bold text-sm">Kelas Mengaji</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </a>
                    </nav>

                    {{-- Quick Nav --}}
                    <div class="mt-8 pt-8 border-t border-emerald-200 dark:border-emerald-500/20">
                        <h3 class="font-bold text-gray-900 dark:text-white mb-4 text-sm uppercase tracking-wider">Urutan Sholat</h3>
                        <div class="flex flex-wrap gap-2">
                             @foreach($steps as $step)
                             <a href="#step-{{ $step['no'] }}" class="px-3 py-1.5 bg-gray-50 dark:bg-slate-700/50 hover:bg-emerald-500 hover:text-white dark:hover:bg-emerald-600 text-gray-600 dark:text-gray-400 rounded-lg text-xs font-medium transition duration-300 border border-emerald-200 dark:border-emerald-500/20">
                                 {{ $step['no'] }}. {{ Str::limit($step['nama'], 15) }}
                             </a>
                             @endforeach
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
</x-public-layout>
