<x-public-layout>
    <x-slot name="title">{{ $pengumuman->title }}</x-slot>

    <article>
        {{-- Hero --}}
        <div class="relative bg-gradient-to-br from-emerald-900 via-emerald-800 to-emerald-900 text-white overflow-hidden">
             <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/diagmonds-light.png')] opacity-10"></div>
             <div class="absolute bottom-0 left-0 w-full h-16 bg-gradient-to-t from-gray-50 dark:from-slate-900 to-transparent"></div>

             <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-24">
                 <div class="mb-6">
                    <a href="{{ route('public.pengumuman.index') }}" class="inline-flex items-center text-emerald-200 hover:text-white text-sm transition font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Kembali ke Pengumuman
                    </a>
                </div>

                <div class="flex items-center gap-3 mb-4">
                    <span class="px-3 py-1 bg-emerald-700/50 rounded-lg text-xs font-bold uppercase tracking-wider border border-emerald-500/30">Pengumuman</span>
                    @if($pengumuman->expired_at)
                    <span class="flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider {{ $pengumuman->expired_at->isPast() ? 'bg-rose-900/50 text-rose-200 border border-rose-500/30' : 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/20' }}">
                        @if(!$pengumuman->expired_at->isPast()) <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-200 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-400"></span></span> @endif
                        {{ $pengumuman->expired_at->isPast() ? 'Kadaluarsa' : 'Berlaku s/d ' . $pengumuman->expired_at->format('d M Y') }}
                    </span>
                    @endif
                </div>

                <h1 class="text-3xl md:text-5xl font-black leading-tight mb-8">{{ $pengumuman->title }}</h1>

                <div class="flex items-center gap-4 border-t border-white/10 pt-6">
                     <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-600 flex items-center justify-center text-white font-bold text-sm shadow-lg ring-2 ring-emerald-500/50">
                            {{ $pengumuman->creator ? strtoupper(substr($pengumuman->creator->name, 0, 1)) : 'A' }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-white">{{ $pengumuman->creator->name ?? 'Admin' }}</p>
                            <p class="text-xs text-emerald-200">Diposting {{ $pengumuman->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
             </div>
        </div>

        {{-- Content --}}
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="prose prose-lg prose-emerald dark:prose-invert max-w-none bg-white dark:bg-slate-800 p-8 rounded-3xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-emerald-200 dark:border-emerald-500/20 relative -mt-20 z-10">
                {!! $pengumuman->content !!}
            </div>

            <div class="mt-12 text-center">
                 <p class="text-sm font-bold text-gray-500 dark:text-gray-400 mb-4 tracking-wider uppercase">Bagikan Pengumuman</p>
                 <div class="flex justify-center gap-3">
                     <a href="https://wa.me/?text={{ urlencode($pengumuman->title . ' - ' . url()->current()) }}" target="_blank" class="px-5 py-2.5 rounded-xl bg-[#25D366] text-white font-bold hover:shadow-lg transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                        WhatsApp
                     </a>
                 </div>
            </div>
        </div>
    </article>
</x-public-layout>
