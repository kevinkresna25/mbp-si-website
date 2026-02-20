<x-public-layout>
    {{-- Page Header --}}
    <x-page-header :title="$article->title" breadcrumb="Artikel / Detail">
        <div class="flex flex-wrap justify-center items-center gap-4 mt-4 animate-fade-in-up" style="animation-delay: 0.2s;">
            <div class="flex items-center gap-2 bg-emerald-100 dark:bg-emerald-900/30 px-3 py-1 rounded-full border border-emerald-200 dark:border-emerald-500/20">
                @if($article->author)
                    <div class="w-6 h-6 rounded-full bg-emerald-500 flex items-center justify-center text-white text-[10px] font-bold">
                        {{ strtoupper(substr($article->author->name, 0, 1)) }}
                    </div>
                    <span class="text-xs font-bold text-emerald-800 dark:text-emerald-200 uppercase tracking-wider">{{ $article->author->name }}</span>
                @else
                    <span class="text-xs font-bold text-emerald-800 dark:text-emerald-200 uppercase tracking-wider">Admin</span>
                @endif
            </div>

            <span class="hidden sm:inline-block w-1 h-1 bg-gray-300 dark:bg-gray-600 rounded-full"></span>

            <div class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400 font-medium">
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $article->published_at->format('d F Y') }}
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    3 Menit Baca
                </div>
                <div class="flex items-center gap-1.5">
                     <span class="px-2 py-0.5 rounded-md bg-gray-100 dark:bg-slate-800 text-xs font-bold text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-white/10 uppercase tracking-wider">
                        {{ $article->category->name }}
                    </span>
                </div>
            </div>
        </div>
    </x-page-header>

    {{-- Content Section --}}
    <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
        
        {{-- Featured Image --}}
        @if($article->featured_image)
        <div class="rounded-3xl shadow-lg shadow-gray-200/50 dark:shadow-none overflow-hidden border border-gray-100 dark:border-white/10 mb-12 animate-fade-in-up" style="animation-delay: 0.3s;">
             <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-auto object-cover max-h-[500px]">
        </div>
        @endif

        {{-- Main Content --}}
        <div class="prose prose-lg prose-emerald dark:prose-invert max-w-none mx-auto bg-white dark:bg-slate-800/50 p-0 sm:p-8 rounded-3xl dark:sm:border dark:border-white/5">
             <div class="prose prose-lg prose-emerald dark:prose-invert max-w-none">
                {!! $article->content !!}
            </div>
        </div>

        {{-- Footer: Tags & Share --}}
        <div class="mt-16 pt-8 border-t border-gray-100 dark:border-white/10">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                 <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 rounded-full text-sm font-medium border border-emerald-100 dark:border-emerald-500/20">
                        #{{ $article->category->name }}
                    </span>
                    <span class="px-3 py-1 bg-gray-50 dark:bg-slate-800 text-gray-500 dark:text-gray-400 rounded-full text-sm font-medium border border-gray-100 dark:border-white/5">
                        #MasjidBukitPalma
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <span class="text-sm font-bold text-gray-400 uppercase tracking-wider mr-2">Bagikan</span>
                    <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}" target="_blank" class="w-10 h-10 flex items-center justify-center rounded-full bg-[#25D366] text-white hover:shadow-lg hover:-translate-y-1 transition duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                    </a>
                    <button onclick="navigator.clipboard.writeText('{{ url()->current() }}').then(() => alert('Link berhasil disalin!'))" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 dark:bg-slate-700 text-gray-500 dark:text-gray-300 hover:bg-gray-800 hover:text-white dark:hover:bg-white dark:hover:text-slate-900 transition duration-300" title="Salin Link">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </article>

    {{-- Related Articles --}}
    @if($relatedArticles->count() > 0)
    <div class="bg-gray-50 dark:bg-slate-900/50 py-16 border-t border-gray-100 dark:border-white/5 relative overflow-hidden">
             {{-- Background Decoration --}}
             <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>

             <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                 <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Baca Artikel Lainnya</h2>
                    <a href="{{ route('public.artikel.index') }}" class="group flex items-center text-emerald-600 dark:text-emerald-400 font-bold hover:underline">
                        Lihat Semua
                        <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedArticles as $related)
                    <article class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-gray-100 dark:border-white/5 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition duration-300 group h-full flex flex-col">
                        <div class="aspect-video bg-gray-100 dark:bg-slate-700 overflow-hidden relative">
                             @if($related->featured_image)
                                <img src="{{ Storage::url($related->featured_image) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                             @else
                                 <div class="w-full h-full flex items-center justify-center bg-emerald-50 dark:bg-slate-700 text-emerald-200 dark:text-slate-600">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                             @endif
                             <div class="absolute top-4 left-4">
                                 <span class="px-3 py-1 bg-white/90 dark:bg-black/60 backdrop-blur-md rounded-full text-xs font-bold text-emerald-700 dark:text-emerald-400 shadow-sm border border-white/20">
                                    {{ $related->category->name }}
                                </span>
                             </div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="mb-4 flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 font-medium">
                                 <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                 {{ $related->published_at->format('d F Y') }}
                            </div>
                            <a href="{{ route('public.artikel.show', $related->slug) }}" class="block mb-3">
                                 <h3 class="text-lg font-bold text-gray-900 dark:text-white leading-tight group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition line-clamp-2">
                                    {{ $related->title }}
                                </h3>
                            </a>
                            <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2 mb-4">
                                {{ Str::limit(strip_tags($related->content), 100) }}
                            </p>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
    </div>
    @endif
</x-public-layout>
