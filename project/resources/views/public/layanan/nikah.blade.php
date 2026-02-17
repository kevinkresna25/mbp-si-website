<x-public-layout>
    <x-page-header :title="$page->title" subtitle="Informasi pendaftaran dan pelaksanaan akad nikah" breadcrumb="Layanan / Akad Nikah" />

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <x-bento.grid>
             {{-- Content --}}
             <x-bento.item span="2" class="p-8">
                <div class="prose prose-emerald dark:prose-invert max-w-none">
                    {!! $page->content !!}
                </div>

                {{-- CTA --}}
                <div class="mt-8 bg-emerald-50 dark:bg-emerald-900/10 border border-emerald-100 dark:border-emerald-500/20 rounded-2xl p-8 text-center">
                    <h3 class="text-xl font-bold text-emerald-900 dark:text-emerald-100 mb-2">Tertarik Melangsungkan Akad Nikah?</h3>
                    <p class="text-emerald-700 dark:text-emerald-300 mb-6">Silakan hubungi sekretariat masjid melalui WhatsApp untuk informasi lebih lanjut dan pendaftaran.</p>
                    <a href="https://wa.me/{{ site_setting('social_whatsapp', '6281234567800') }}?text={{ urlencode('Assalamualaikum, saya ingin bertanya tentang layanan nikah di ' . site_setting('site_name', 'Masjid Bukit Palma') . '.') }}" target="_blank"
                        class="inline-flex items-center px-8 py-3 bg-[#25D366] text-white text-sm font-bold rounded-xl hover:shadow-lg hover:scale-105 transition duration-300">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                        Hubungi via WhatsApp
                    </a>
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
