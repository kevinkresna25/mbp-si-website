<x-public-layout>
    <x-page-header :title="$pengumuman->title" breadcrumb="Pengumuman / Detail">
        <div class="flex flex-wrap justify-center gap-3 mt-4 animate-fade-in-up" style="animation-delay: 0.2s;">
            <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 rounded-full text-xs font-bold uppercase tracking-wider border border-emerald-200 dark:border-emerald-500/20">
                {{ $pengumuman->creator->name ?? 'Admin' }}
            </span>
            <span class="px-3 py-1 bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-gray-400 rounded-full text-xs font-bold uppercase tracking-wider border border-gray-200 dark:border-white/10">
                {{ $pengumuman->created_at->diffForHumans() }}
            </span>
             @if($pengumuman->expired_at)
            <span class="flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border {{ $pengumuman->expired_at->isPast() ? 'bg-rose-100 text-rose-700 border-rose-200' : 'bg-emerald-100 text-emerald-700 border-emerald-200' }}">
                @if(!$pengumuman->expired_at->isPast()) <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span></span> @endif
                {{ $pengumuman->expired_at->isPast() ? 'Kadaluarsa' : 'Berlaku s/d ' . $pengumuman->expired_at->format('d M Y') }}
            </span>
            @endif
        </div>
    </x-page-header>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
        {{-- Content Card --}}
        <article class="bg-white dark:bg-slate-800 rounded-3xl p-8 md:p-12 shadow-sm border border-emerald-100 dark:border-white/5 relative overflow-hidden">
             {{-- Decorative Background --}}
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 dark:bg-emerald-900/10 rounded-full blur-2xl -mr-10 -mt-10"></div>
            
            <div class="prose prose-lg prose-emerald dark:prose-invert max-w-none relative z-10">
                {!! $pengumuman->content !!}
            </div>

            {{-- Share Section --}}
            <div class="mt-12 pt-8 border-t border-gray-100 dark:border-white/5 text-center">
                 <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Bagikan Pengumuman</p>
                 <div class="flex justify-center gap-3">
                     <a href="https://wa.me/?text={{ urlencode($pengumuman->title . ' - ' . url()->current()) }}" target="_blank" class="px-5 py-2.5 rounded-xl bg-[#25D366] text-white font-bold hover:shadow-lg hover:-translate-y-0.5 transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                        WhatsApp
                     </a>
                     
                     <div class="hidden sm:block">
                        <a href="{{ route('public.pengumuman.index') }}" class="px-5 py-2.5 rounded-xl bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-gray-300 font-bold hover:bg-gray-200 dark:hover:bg-slate-600 transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Kembali
                        </a>
                     </div>
                 </div>
            </div>
        </article>
    </div>
</x-public-layout>
