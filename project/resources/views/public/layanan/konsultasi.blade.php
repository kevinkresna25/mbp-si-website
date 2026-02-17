<x-public-layout>
    <x-page-header title="Konsultasi Agama" subtitle="Tanyakan permasalahan agama Anda kepada ustadz dan asatidz di Masjid Bukit Palma" breadcrumb="Layanan / Konsultasi" />

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <x-bento.grid>
            {{-- Content --}}
            <x-bento.item span="2" class="space-y-8">
                
                {{-- Info Box --}}
                <div class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-500/30 rounded-2xl p-6 flex items-start gap-4">
                    <div class="p-2 bg-emerald-100 dark:bg-emerald-800 rounded-lg shrink-0 text-emerald-600 dark:text-emerald-100">
                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-emerald-900 dark:text-emerald-100 mb-1">Layanan Konsultasi Gratis</h3>
                        <p class="text-sm text-emerald-800 dark:text-emerald-200 leading-relaxed">Konsultasi agama ini bersifat gratis dan terbuka untuk seluruh jamaah. Silakan menghubungi ustadz/asatidz yang tersedia sesuai jadwal konsultasi masing-masing melalui WhatsApp.</p>
                    </div>
                </div>

                {{-- Ustadz Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($ustadzList as $ustadz)
                    <div class="bg-white dark:bg-slate-700/30 rounded-2xl border border-gray-100 dark:border-white/5 p-6 hover:shadow-lg transition flex flex-col items-center text-center group">
                        <div class="w-24 h-24 rounded-full bg-emerald-100 dark:bg-slate-600 flex items-center justify-center mb-4 text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition duration-300">
                             <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">{{ $ustadz['nama'] }}</h3>
                        <p class="text-sm text-emerald-600 dark:text-emerald-400 font-medium mb-4">{{ $ustadz['bidang'] }}</p>
                        
                        <div class="w-full bg-gray-50 dark:bg-slate-800/50 rounded-xl p-3 mb-6 border border-gray-100 dark:border-white/5">
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-bold mb-1">Jadwal</p>
                            <p class="text-sm text-gray-900 dark:text-white font-medium">{{ $ustadz['jadwal'] }}</p>
                        </div>
                        
                        <a href="https://wa.me/{{ $ustadz['wa'] }}?text={{ urlencode('Assalamualaikum ' . $ustadz['nama'] . ', saya ingin berkonsultasi mengenai masalah agama.') }}" target="_blank"
                            class="mt-auto w-full px-4 py-2.5 bg-[#25D366] text-white text-sm font-bold rounded-xl hover:shadow-lg transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                            Konsultasi via WhatsApp
                        </a>
                    </div>
                    @endforeach
                </div>
                
                 {{-- Bidang Info --}}
                <div class="border-t border-gray-100 dark:border-white/5 pt-8">
                     <h3 class="font-bold text-gray-900 dark:text-white mb-6">Bidang Konsultasi</h3>
                     <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                         <div class="flex items-center space-x-3 p-4 bg-gray-50 dark:bg-slate-700/30 rounded-xl border border-gray-100 dark:border-white/5">
                             <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center flex-shrink-0 text-emerald-600 dark:text-emerald-400">
                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                             </div>
                             <span class="font-medium text-gray-700 dark:text-gray-300">Fiqih Ibadah</span>
                         </div>
                         <div class="flex items-center space-x-3 p-4 bg-gray-50 dark:bg-slate-700/30 rounded-xl border border-gray-100 dark:border-white/5">
                             <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center flex-shrink-0 text-emerald-600 dark:text-emerald-400">
                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                             </div>
                             <span class="font-medium text-gray-700 dark:text-gray-300">Pernikahan & Keluarga</span>
                         </div>
                     </div>
                </div>
            </x-bento.item>

            {{-- Sidebar --}}
            <div class="space-y-6">
                <x-sidebar-menu title="Layanan Masjid" :links="[
                    ['label' => 'Jadwal Salat', 'url' => '/layanan/jadwal-salat', 'color' => 'bg-emerald-500'],
                    ['label' => 'Konsultasi Agama', 'url' => '/layanan/konsultasi', 'color' => 'bg-blue-500'],
                    ['label' => 'Akad Nikah', 'url' => '/layanan/nikah', 'color' => 'bg-pink-500'],
                    ['label' => 'Permohonan', 'url' => '/layanan/permohonan', 'color' => 'bg-amber-500'],
                ]" />
            </div>
        </x-bento.grid>
    </section>
</x-public-layout>
