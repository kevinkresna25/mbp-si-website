<x-public-layout>
    <x-slot name="title">{{ $videoCeramah->judul }}</x-slot>

    <article>
        {{-- Hero --}}
        <div class="relative bg-black text-white overflow-hidden">
             
             <div class="absolute inset-0 bg-gradient-to-br from-gray-900 to-black z-0"></div>
             
             <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16 grid grid-cols-1 lg:grid-cols-3 gap-8 items-center z-10">
                 <div class="lg:col-span-2 space-y-6">
                    <div class="mb-4">
                        <a href="{{ route('public.video-ceramah.index') }}" class="inline-flex items-center text-gray-400 hover:text-white text-sm transition font-medium">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            Kembali ke Video
                        </a>
                    </div>
                    
                    <h1 class="text-3xl md:text-5xl font-black leading-tight">{{ $videoCeramah->judul }}</h1>
                    
                    <div class="flex flex-wrap items-center gap-6 text-gray-400 text-sm">
                        @if($videoCeramah->ustadz)
                        <div class="flex items-center gap-2">
                             <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-white shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <span class="font-bold text-gray-200">{{ $videoCeramah->ustadz }}</span>
                        </div>
                        @endif
                         <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>{{ $videoCeramah->durasi ?? '00:00' }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span>{{ $videoCeramah->created_at->format('d F Y') }}</span>
                        </div>
                    </div>
                 </div>
             </div>
        </div>

        {{-- Video Player Section --}}
        <div class="bg-gray-50 dark:bg-slate-900 border-b border-gray-200 dark:border-white/5">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 -mt-12 md:-mt-24 relative z-20">
                 @php
                    $videoUrl = $videoCeramah->video_url;
                    $embedUrl = null;
                    if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoUrl, $matches)) {
                        $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
                    }
                @endphp

                <div class="aspect-video bg-black rounded-2xl shadow-2xl overflow-hidden ring-4 ring-white dark:ring-slate-800">
                    @if($embedUrl)
                         <iframe src="{{ $embedUrl }}" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-center p-8">
                            <svg class="w-16 h-16 text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                             <p class="text-gray-400 mb-4">Video ini tidak dapat diputar langsung disini.</p>
                             <a href="{{ $videoUrl }}" target="_blank" class="px-6 py-2 bg-emerald-600 text-white font-bold rounded-lg hover:bg-emerald-700 transition">Tonton di Sumber Asli</a>
                        </div>
                    @endif
                </div>

                <div class="mt-8 flex justify-center">
                    <a href="https://wa.me/?text={{ urlencode('Tonton video kajian ini: ' . $videoCeramah->judul . ' - ' . url()->current()) }}" target="_blank" class="px-6 py-3 rounded-xl bg-[#25D366] text-white font-bold hover:shadow-lg transition flex items-center gap-2 shadow-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                        Bagikan Video
                     </a>
                </div>
            </div>
        </div>

        {{-- Related Videos --}}
        @if($relatedVideos->count() > 0)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Video Kajian Lainnya</h2>
                <a href="{{ route('public.video-ceramah.index') }}" class="text-emerald-600 dark:text-emerald-400 font-bold hover:underline">Lihat Semua</a>
            </div>
            <x-card-grid>
                @foreach($relatedVideos as $related)
                <article class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-white/5 overflow-hidden hover:shadow-md transition group h-full flex flex-col">
                    <div class="aspect-video bg-gray-100 dark:bg-slate-700 overflow-hidden relative">
                         <a href="{{ route('public.video-ceramah.show', $related) }}" class="block w-full h-full">
                             @if($related->thumbnail)
                                <img src="{{ Storage::url($related->thumbnail) }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105 opacity-90 group-hover:opacity-100">
                             @else
                                 <div class="w-full h-full flex items-center justify-center bg-gray-800">
                                    <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                             @endif
                             
                             <div class="absolute inset-0 bg-black/30 group-hover:bg-black/10 transition flex items-center justify-center">
                                 <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center border border-white/40 group-hover:scale-110 transition">
                                     <svg class="w-6 h-6 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                 </div>
                             </div>

                             @if($related->durasi)
                             <span class="absolute bottom-2 right-2 bg-black/80 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-0.5 rounded border border-white/10">{{ $related->durasi }}</span>
                             @endif
                         </a>
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <a href="{{ route('public.video-ceramah.show', $related) }}" class="block mb-2">
                             <h3 class="text-base font-bold text-gray-900 dark:text-white leading-tight group-hover:text-emerald-500 dark:group-hover:text-emerald-400 transition line-clamp-2">{{ $related->judul }}</h3>
                        </a>
                        <div class="mt-auto flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                            <span>{{ $related->ustadz ?? 'N/A' }}</span>
                            <span>{{ $related->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </article>
                @endforeach
            </x-card-grid>
        </section>
        @endif
    </article>
</x-public-layout>
