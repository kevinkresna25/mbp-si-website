<x-public-layout>
    <x-page-header title="Konsultasi Agama" subtitle="Tanyakan permasalahan agama Anda kepada ustadz dan asatidz di Masjid Bukit Palma" breadcrumb="Layanan / Konsultasi" />

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 relative">
        {{-- Background Decoration --}}
        <div class="absolute top-20 right-0 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute bottom-20 left-0 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Content --}}
            <div class="lg:col-span-2 space-y-8">
                
                {{-- Info Box --}}
                <div class="bg-gradient-to-br from-emerald-50 to-white dark:from-emerald-900/20 dark:to-slate-800 border border-emerald-100 dark:border-emerald-500/20 rounded-3xl p-6 md:p-8 flex flex-col md:flex-row items-center md:items-start gap-6 shadow-sm relative overflow-hidden">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')] opacity-5 pointer-events-none"></div>
                    <div class="w-16 h-16 bg-emerald-100 dark:bg-emerald-800/50 rounded-2xl flex items-center justify-center shrink-0 text-emerald-600 dark:text-emerald-300 shadow-inner">
                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="text-center md:text-left relative z-10">
                        <h3 class="text-xl font-bold text-emerald-900 dark:text-emerald-100 mb-2">Layanan Konsultasi Gratis</h3>
                        <p class="text-base text-emerald-800 dark:text-emerald-200 leading-relaxed">
                            Alhamdulillah, Masjid Bukit Palma menyediakan layanan konsultasi agama <strong>gratis</strong> untuk seluruh jamaah. 
                            Anda dapat bertanya langsung kepada Ustadz/Asatidz kami melalui WhatsApp sesuai dengan jadwal dan bidang keilmuan beliau.
                        </p>
                    </div>
                </div>

                {{-- Ustadz Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($ustadzList as $ustadz)
                    <div class="bg-white dark:bg-slate-800 rounded-3xl border border-emerald-200 dark:border-emerald-500/20 p-6 hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col items-center text-center group relative overflow-hidden">
                        {{-- Hover Gradient --}}
                        <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 transform scale-x-0 group-hover:scale-x-100 transition duration-500 origin-left"></div>
                        
                        <div class="relative w-28 h-28 mb-4">
                            <div class="absolute inset-0 bg-emerald-100 dark:bg-emerald-900/30 rounded-full animate-pulse group-hover:animate-none"></div>
                            <div class="relative w-full h-full rounded-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center text-emerald-600 dark:text-emerald-400 ring-4 ring-white dark:ring-slate-800 shadow-lg">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition">{{ $ustadz['nama'] }}</h3>
                        <span class="px-3 py-1 rounded-full bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-300 text-xs font-bold uppercase tracking-wider mb-6 border border-emerald-100 dark:border-emerald-500/20">
                            {{ $ustadz['bidang'] }}
                        </span>
                        
                        <div class="w-full bg-gray-50 dark:bg-slate-700/30 rounded-2xl p-4 mb-6 border border-emerald-200 dark:border-emerald-500/20">
                            <div class="flex items-center justify-center gap-2 mb-1 text-gray-400 dark:text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-xs font-bold uppercase tracking-wider">Jadwal</span>
                            </div>
                            <p class="text-sm text-gray-900 dark:text-white font-medium">{{ $ustadz['jadwal'] }}</p>
                        </div>
                        
                        <a href="https://wa.me/{{ $ustadz['wa'] }}?text={{ urlencode('Assalamualaikum ' . $ustadz['nama'] . ', saya ingin berkonsultasi mengenai masalah agama.') }}" target="_blank"
                            class="mt-auto w-full px-4 py-3 bg-[#25D366] text-white text-sm font-bold rounded-xl hover:bg-[#20bd5a] hover:shadow-lg hover:shadow-green-500/20 transition flex items-center justify-center gap-2 group/btn">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                            Chat WhatsApp
                        </a>
                    </div>
                    @endforeach
                </div>
                
                 {{-- Bidang Info --}}
                <div class="bg-gray-50 dark:bg-slate-800/50 rounded-3xl p-8 border border-emerald-200 dark:border-emerald-500/20">
                     <h3 class="font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        Topik Konsultasi Populer
                    </h3>
                     <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                         <div class="group flex items-center space-x-4 p-4 bg-white dark:bg-slate-700/50 rounded-2xl border border-emerald-200 dark:border-emerald-500/20 hover:border-emerald-200 dark:hover:border-emerald-500/30 transition shadow-sm">
                             <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center flex-shrink-0 text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition">
                                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                             </div>
                             <div>
                                 <span class="block font-bold text-gray-900 dark:text-white">Fiqih Ibadah</span>
                                 <span class="text-xs text-gray-500 dark:text-gray-400">Tata cara salat, puasa, zakat</span>
                             </div>
                         </div>
                         <div class="group flex items-center space-x-4 p-4 bg-white dark:bg-slate-700/50 rounded-2xl border border-emerald-200 dark:border-emerald-500/20 hover:border-emerald-200 dark:hover:border-emerald-500/30 transition shadow-sm">
                             <div class="w-12 h-12 bg-pink-100 dark:bg-pink-900/30 rounded-xl flex items-center justify-center flex-shrink-0 text-pink-600 dark:text-pink-400 group-hover:scale-110 transition">
                                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                             </div>
                             <div>
                                 <span class="block font-bold text-gray-900 dark:text-white">Keluarga Sakinah</span>
                                 <span class="text-xs text-gray-500 dark:text-gray-400">Pernikahan & parenting</span>
                             </div>
                         </div>
                         <div class="group flex items-center space-x-4 p-4 bg-white dark:bg-slate-700/50 rounded-2xl border border-emerald-200 dark:border-emerald-500/20 hover:border-emerald-200 dark:hover:border-emerald-500/30 transition shadow-sm">
                             <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center flex-shrink-0 text-blue-600 dark:text-blue-400 group-hover:scale-110 transition">
                                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                             </div>
                             <div>
                                 <span class="block font-bold text-gray-900 dark:text-white">Muamalah</span>
                                 <span class="text-xs text-gray-500 dark:text-gray-400">Hukum jual beli & bisnis</span>
                             </div>
                         </div>
                         <div class="group flex items-center space-x-4 p-4 bg-white dark:bg-slate-700/50 rounded-2xl border border-emerald-200 dark:border-emerald-500/20 hover:border-emerald-200 dark:hover:border-emerald-500/30 transition shadow-sm">
                             <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900/30 rounded-xl flex items-center justify-center flex-shrink-0 text-amber-600 dark:text-amber-400 group-hover:scale-110 transition">
                                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.2-2.858.5-4.193"/></svg>
                             </div>
                             <div>
                                 <span class="block font-bold text-gray-900 dark:text-white">Aqidah & Akhlak</span>
                                 <span class="text-xs text-gray-500 dark:text-gray-400">Keimanan & perilaku</span>
                             </div>
                         </div>
                     </div>
                </div>
            </div>

            {{-- Sidebar (Menu Layanan) --}}
            <div class="space-y-6">
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-lg shadow-gray-200/50 dark:shadow-none border border-emerald-200 dark:border-emerald-500/20 sticky top-24">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                        Layanan Lainnya
                    </h3>
                    <nav class="space-y-2">
                        <a href="{{ route('public.layanan.jadwal-salat') }}" 
                            class="flex items-center justify-between p-4 rounded-xl transition-all duration-300 {{ request()->routeIs('public.layanan.jadwal-salat') ? 'bg-emerald-500 text-white shadow-emerald-500/30 shadow-lg' : 'bg-gray-50 dark:bg-slate-700/30 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-slate-700 hover:text-emerald-600 dark:hover:text-emerald-400' }}">
                            <span class="font-bold text-sm">Jadwal Salat</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </a>
                        <a href="{{ route('public.layanan.konsultasi') }}"
                            class="flex items-center justify-between p-4 rounded-xl transition-all duration-300 {{ request()->routeIs('public.layanan.konsultasi') ? 'bg-emerald-500 text-white shadow-emerald-500/30 shadow-lg' : 'bg-gray-50 dark:bg-slate-700/30 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-slate-700 hover:text-emerald-600 dark:hover:text-emerald-400' }}">
                            <span class="font-bold text-sm">Konsultasi Agama</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        </a>
                        <a href="{{ route('public.layanan.nikah') }}"
                            class="flex items-center justify-between p-4 rounded-xl transition-all duration-300 {{ request()->routeIs('public.layanan.nikah') ? 'bg-emerald-500 text-white shadow-emerald-500/30 shadow-lg' : 'bg-gray-50 dark:bg-slate-700/30 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-slate-700 hover:text-emerald-600 dark:hover:text-emerald-400' }}">
                            <span class="font-bold text-sm">Akad Nikah</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </a>
                        <a href="{{ route('public.layanan.permohonan') }}"
                            class="flex items-center justify-between p-4 rounded-xl transition-all duration-300 {{ request()->routeIs('public.layanan.permohonan') ? 'bg-emerald-500 text-white shadow-emerald-500/30 shadow-lg' : 'bg-gray-50 dark:bg-slate-700/30 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-slate-700 hover:text-emerald-600 dark:hover:text-emerald-400' }}">
                            <span class="font-bold text-sm">Permohonan Surat</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
