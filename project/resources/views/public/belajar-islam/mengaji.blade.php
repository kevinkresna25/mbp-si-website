<x-public-layout>
    <x-page-header title="Kelas Mengaji" subtitle="Program belajar Al-Quran di Masjid Bukit Palma untuk semua usia" breadcrumb="Belajar Islam / Mengaji" />

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 relative">
        {{-- Background Decoration --}}
        <div class="absolute top-20 left-0 w-72 h-72 bg-purple-500/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute bottom-20 right-0 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
             {{-- Content --}}
             <div class="lg:col-span-2 space-y-8">
                 <div class="bg-white dark:bg-slate-800 rounded-3xl border border-gray-100 dark:border-white/5 p-8 shadow-xl shadow-gray-200/50 dark:shadow-none relative overflow-hidden">
                     <div class="absolute top-0 right-0 w-40 h-40 bg-emerald-500/5 rounded-full blur-2xl -z-10"></div>
                     <p class="text-xl text-gray-700 dark:text-gray-200 leading-relaxed font-serif italic text-center">
                         "Sebaik-baik kalian adalah orang yang belajar Al-Quran dan mengajarkannya."
                     </p>
                     <p class="text-sm text-center text-gray-500 dark:text-gray-400 mt-2 font-bold uppercase tracking-wider">(HR. Bukhari)</p>
                 </div>

                 <div class="grid grid-cols-1 gap-6">
                    @foreach($classes as $kelas)
                    @php
                        $colorMap = [
                            'blue' => [
                                'gradient' => 'from-blue-500 to-blue-600',
                                'bg' => 'bg-blue-50 dark:bg-blue-900/10',
                                'border' => 'border-blue-100 dark:border-blue-500/20',
                                'text' => 'text-blue-600 dark:text-blue-400',
                                'btn' => 'bg-blue-500 hover:bg-blue-600 shadow-blue-500/30'
                            ],
                            'emerald' => [
                                'gradient' => 'from-emerald-500 to-emerald-600',
                                'bg' => 'bg-emerald-50 dark:bg-emerald-900/10',
                                'border' => 'border-emerald-100 dark:border-emerald-500/20',
                                'text' => 'text-emerald-600 dark:text-emerald-400',
                                'btn' => 'bg-emerald-500 hover:bg-emerald-600 shadow-emerald-500/30'
                            ],
                            'purple' => [
                                'gradient' => 'from-purple-500 to-purple-600',
                                'bg' => 'bg-purple-50 dark:bg-purple-900/10',
                                'border' => 'border-purple-100 dark:border-purple-500/20',
                                'text' => 'text-purple-600 dark:text-purple-400',
                                'btn' => 'bg-purple-500 hover:bg-purple-600 shadow-purple-500/30'
                            ],
                            'amber' => [
                                'gradient' => 'from-amber-500 to-amber-600',
                                'bg' => 'bg-amber-50 dark:bg-amber-900/10',
                                'border' => 'border-amber-100 dark:border-amber-500/20',
                                'text' => 'text-amber-600 dark:text-amber-400',
                                'btn' => 'bg-amber-500 hover:bg-amber-600 shadow-amber-500/30'
                            ],
                        ];
                        $c = $colorMap[$kelas['color']] ?? $colorMap['emerald'];
                    @endphp
                    
                    <div class="bg-white dark:bg-slate-800 rounded-3xl border border-gray-100 dark:border-white/5 overflow-hidden flex flex-col md:flex-row hover:shadow-2xl transition duration-500 group">
                        {{-- Icon Section --}}
                        <div class="md:w-1/3 bg-gradient-to-br {{ $c['gradient'] }} p-8 flex flex-col items-center justify-center text-center relative overflow-hidden">
                            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')] opacity-10 pointer-events-none"></div>
                            <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center text-white mb-4 shadow-inner border border-white/20 group-hover:scale-110 transition duration-300">
                                @if($kelas['icon'] === 'book-open')
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                @elseif($kelas['icon'] === 'academic-cap')
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                                @elseif($kelas['icon'] === 'users')
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                @else
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                @endif
                            </div>
                            <h3 class="text-xl font-bold text-white mb-1">{{ $kelas['nama'] }}</h3>
                            <p class="text-white/80 text-sm">Masjid Bukit Palma</p>
                        </div>

                        {{-- Details Section --}}
                        <div class="md:w-2/3 p-8 flex flex-col justify-between bg-white dark:bg-slate-800 relative">
                             <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 dark:bg-slate-700/50 rounded-bl-full -z-10 opacity-50"></div>
                             
                             <div>
                                <p class="text-gray-600 dark:text-gray-300 text-base leading-relaxed mb-6">{{ $kelas['deskripsi'] }}</p>
                                
                                <div class="space-y-4 mb-8">
                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 rounded-full {{ $c['bg'] }} flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5 {{ $c['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Jadwal</p>
                                            <p class="text-gray-900 dark:text-white font-medium">{{ $kelas['jadwal'] }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 rounded-full {{ $c['bg'] }} flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5 {{ $c['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Pengajar</p>
                                            <p class="text-gray-900 dark:text-white font-medium">{{ $kelas['pengajar'] }}</p>
                                        </div>
                                    </div>
                                </div>
                             </div>

                             <a href="https://wa.me/{{ $kelas['wa'] }}" target="_blank"
                                class="w-full inline-flex items-center justify-center px-6 py-3 {{ $c['btn'] }} text-white text-sm font-bold rounded-xl shadow-lg transition-all duration-300 hover:-translate-y-1">
                                 <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                                 Daftar via WhatsApp
                             </a>
                        </div>
                    </div>
                    @endforeach
                 </div>
             </div>

             {{-- Sidebar --}}
             <div class="space-y-8">
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-white/5 sticky top-24">
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

                    <div class="mt-8 pt-8 border-t border-gray-100 dark:border-white/5">
                        <x-bento.item class="bg-gradient-to-br from-emerald-600 to-emerald-800 text-white !border-0 text-center !p-6 !rounded-2xl">
                            <h3 class="font-bold text-lg mb-2">Mari Belajar Bersama</h3>
                            <p class="text-sm text-emerald-100 mb-4 opacity-90 leading-relaxed">Ilmu adalah cahaya yang menerangi jalan menuju kebaikan dunia dan akhirat.</p>
                        </x-bento.item>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
