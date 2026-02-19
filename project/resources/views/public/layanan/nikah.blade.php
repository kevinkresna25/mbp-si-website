<x-public-layout>
    <x-page-header :title="$page->title" subtitle="Informasi pendaftaran dan pelaksanaan akad nikah" breadcrumb="Layanan / Akad Nikah" />

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 relative">
        {{-- Background Decoration --}}
        <div class="absolute top-20 right-0 w-72 h-72 bg-pink-500/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute bottom-20 left-0 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
             {{-- Content --}}
             <div class="lg:col-span-2 space-y-8">
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-emerald-200 dark:border-emerald-500/20 p-8 shadow-xl shadow-gray-200/50 dark:shadow-none">
                    <div class="prose prose-lg prose-emerald dark:prose-invert max-w-none">
                        {!! $page->content !!}
                    </div>

                    {{-- CTA --}}
                    <div class="mt-12 bg-gradient-to-br from-pink-50 to-white dark:from-pink-900/10 dark:to-slate-800 border border-pink-100 dark:border-pink-500/20 rounded-2xl p-8 text-center relative overflow-hidden group">
                        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')] opacity-5 pointer-events-none"></div>
                        <div class="absolute top-0 right-0 w-32 h-32 bg-pink-500/5 rounded-full blur-2xl -z-10"></div>
                        
                        <div class="w-16 h-16 bg-pink-100 dark:bg-pink-900/30 rounded-2xl flex items-center justify-center mx-auto mb-6 text-pink-500 dark:text-pink-400 transform group-hover:scale-110 transition duration-300 shadow-sm">
                             <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </div>
                        
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Tertarik Melangsungkan Akad Nikah?</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-8 max-w-lg mx-auto leading-relaxed">
                            Jadikan momen sakral Anda lebih bermakna di Masjid Bukit Palma. Silakan hubungi sekretariat kami untuk informasi jadwal dan persyaratan.
                        </p>
                        
                        <a href="https://wa.me/{{ site_setting('social_whatsapp', '6281234567800') }}?text={{ urlencode('Assalamualaikum, saya ingin bertanya tentang layanan nikah di ' . site_setting('site_name', 'Masjid Bukit Palma') . '.') }}" target="_blank"
                            class="inline-flex items-center px-8 py-4 bg-[#25D366] text-white text-base font-bold rounded-xl hover:bg-[#20bd5a] hover:shadow-lg hover:shadow-green-500/30 hover:-translate-y-1 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                            Hubungi via WhatsApp
                        </a>
                    </div>
                </div>
             </div>
 
             {{-- Sidebar (Menu Layanan) --}}
            <div class="space-y-6">
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-white/5 sticky top-24">
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
