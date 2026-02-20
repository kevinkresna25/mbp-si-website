<x-public-layout>
    <x-slot name="title">Visi & Misi</x-slot>
    <x-page-header :title="$page->title ?? 'Visi & Misi'" subtitle="Menjadikan Masjid Bukit Palma sebagai pusat peradaban yang mencerahkan dan memberdayakan umat." breadcrumb="Profil / Visi & Misi" />
    
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 relative">
        {{-- Background Decoration --}}
        <div class="absolute top-20 right-0 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute bottom-20 left-0 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-emerald-200 dark:border-emerald-500/20 p-8 shadow-xl shadow-gray-200/50 dark:shadow-none">
                    @if($page)
                        <div class="flex items-center gap-4 mb-6 border-b border-gray-100 dark:border-white/5 pb-6">
                            <div class="w-12 h-12 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400 font-bold text-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $page->title }}</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Diperbarui {{ $page->updated_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>

                        <div class="prose prose-emerald dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 leading-relaxed">
                            {!! $page->content !!}
                        </div>
                    @else
                        <div class="text-center py-12">
                             <div class="w-16 h-16 bg-gray-100 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400">Konten Visi & Misi belum tersedia.</p>
                        </div>
                    @endif
                </div>

                {{-- Quote Box --}}
                <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/10 dark:to-teal-900/10 border border-emerald-100 dark:border-emerald-500/20 text-center relative overflow-hidden rounded-3xl shadow-lg group hover:scale-[1.02] transition duration-500 p-8">
                    <div class="absolute inset-0 bg-white/40 dark:bg-slate-900/40 opacity-20 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:16px_16px]"></div>
                    <div class="relative z-10">
                        <svg class="w-8 h-8 text-emerald-500 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.0547 15.1953 15.1094 17.5508 15.1641C18.6758 15.1914 19.332 15.6562 19.5195 16.5586L19.7812 16.4883C19.7148 15.4258 19.4648 14.5078 19.0312 13.7344C18.1758 12.1836 16.5938 11.4531 14.2812 11.543L14.0177 11.2383C14.0527 10.3711 14.375 9.48828 14.9844 8.58984C15.6094 7.64453 16.4883 6.94531 17.6211 6.49219L17.75 6.77344C16.9062 7.15234 16.332 7.64453 16.0273 8.24609C15.7227 8.84766 15.5859 9.54297 15.6172 10.332C16.5195 10.2266 17.2969 10.457 17.9492 11.0234C18.6016 11.5898 18.9219 12.3516 18.9062 13.3086C18.8828 14.2422 18.5273 15.0195 17.8438 15.6406C17.1602 16.2617 16.3164 16.5586 15.3125 16.5352C14.7383 16.5234 14.3047 16.332 14.0156 15.9609L14.017 21ZM5.52344 21L5.52344 18C5.52344 16.0547 6.70312 15.1094 9.0625 15.1641C10.1875 15.1914 10.8438 15.6562 11.0312 16.5586L11.293 16.4883C11.2266 15.4258 10.9766 14.5078 10.543 13.7344C9.69141 12.1836 8.10938 11.4531 5.79688 11.543L5.52344 11.2383C5.55859 10.3711 5.88281 9.48828 6.49219 8.58984C7.11719 7.64453 8.00391 6.94531 9.13672 6.49219L9.26172 6.77344C8.42188 7.15234 7.84766 7.64453 7.54297 8.24609C7.23828 8.84766 7.10156 9.54297 7.13281 10.332C8.03516 10.2266 8.8125 10.457 9.46484 11.0234C10.1172 11.5898 10.4375 12.3516 10.4219 13.3086C10.3984 14.2422 10.043 15.0195 9.35547 15.6406C8.67578 16.2617 7.83203 16.5586 6.82422 16.5352C6.25 16.5234 5.81641 16.332 5.52734 15.9609L5.52344 21Z"/></svg>
                        <p class="font-medium text-lg leading-relaxed italic mb-4 text-emerald-900 dark:text-emerald-100">"Dan hendaklah ada di antara kamu segolongan umat yang menyeru kepada kebajikan..."</p>
                        <p class="text-xs font-bold uppercase tracking-widest text-emerald-600 dark:text-emerald-400">(QS. Ali Imran: 104)</p>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6 sticky top-24 h-fit">
                <x-profil-sidebar />
            </div>
        </div>
    </section>
</x-public-layout>
