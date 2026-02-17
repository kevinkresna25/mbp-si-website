<x-public-layout>
    <x-slot name="title">{{ $kegiatan->nama_kegiatan }}</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        {{-- Breadcrumb --}}
        <nav class="flex mb-8 text-sm text-gray-500 dark:text-gray-400">
            <a wire:navigate href="/" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition">Beranda</a>
            <span class="mx-2">/</span>
            <a wire:navigate href="{{ route('public.kegiatan.index') }}" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition">Kegiatan</a>
            <span class="mx-2">/</span>
            <span class="font-semibold text-emerald-600 dark:text-emerald-400 truncate max-w-[200px]">{{ $kegiatan->nama_kegiatan }}</span>
        </nav>

        <x-bento.grid>
            {{-- Hero Title (Full Width Bento Item) --}}
            <x-bento.item span="3" class="bg-gradient-to-br from-emerald-800 to-emerald-950 text-white !border-0 min-h-[300px] flex flex-col justify-center relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')]"></div>
                <div class="absolute right-0 top-0 w-64 h-64 bg-emerald-500 rounded-full blur-3xl opacity-20 -mr-16 -mt-16"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-teal-500 rounded-full blur-3xl opacity-20 -ml-16 -mb-16"></div>
                
                <div class="relative z-10 max-w-4xl">
                     {{-- Badges --}}
                    <div class="flex flex-wrap gap-3 mb-6">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-white/10 text-emerald-100 backdrop-blur-sm border border-white/10">
                            {{ $kegiatan->jenis_label }}
                        </span>
                        @php
                            $statusColor = match($kegiatan->status) {
                                'terlaksana' => 'bg-emerald-500',
                                'sedang_berlangsung' => 'bg-amber-500',
                                'akan_datang' => 'bg-blue-500', 
                                default => 'bg-gray-500'
                            };
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $statusColor }} text-white shadow-lg">
                            {{ $kegiatan->status_label }}
                        </span>
                    </div>

                    <h1 class="text-3xl md:text-5xl font-bold tracking-tight mb-6 leading-tight">
                        {{ $kegiatan->nama_kegiatan }}
                    </h1>

                    <div class="flex flex-wrap gap-6 text-emerald-100/90 text-sm font-medium">
                        <div class="flex items-center gap-2">
                            <div class="p-1.5 rounded-lg bg-white/10 backdrop-blur-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            {{ $kegiatan->tanggal->translatedFormat('l, d F Y') }}
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="p-1.5 rounded-lg bg-white/10 backdrop-blur-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            {{ $kegiatan->waktu ? \Carbon\Carbon::parse($kegiatan->waktu)->format('H:i') . ' WIB' : 'TBA' }}
                        </div>
                    </div>
                </div>
            </x-bento.item>

            {{-- Main Content --}}
            <x-bento.item span="2" class="min-h-[400px]">
                 {{-- Banner Image inside Content --}}
                @if($kegiatan->banner_image)
                <div class="rounded-2xl overflow-hidden mb-8 shadow-sm border border-gray-100 dark:border-white/5">
                    <img src="{{ Storage::url($kegiatan->banner_image) }}" alt="{{ $kegiatan->nama_kegiatan }}" class="w-full h-auto object-cover">
                </div>
                @endif

                    <div class="prose prose-lg prose-emerald dark:prose-invert max-w-none text-gray-600 dark:text-gray-300">
                        {!! $kegiatan->deskripsi !!}
                    </div>

                {{-- Related Activities --}}
                @if($relatedKegiatan->count() > 0)
                <div class="mt-12 pt-8 border-t border-gray-100 dark:border-white/5">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Kegiatan Serupa</h3>
                    <div class="space-y-4">
                        @foreach($relatedKegiatan as $related)
                        <a href="{{ route('public.kegiatan.show', $related->id) }}" class="flex items-center gap-4 group">
                            <div class="w-16 h-16 rounded-xl bg-gray-100 dark:bg-slate-700 overflow-hidden relative shrink-0">
                                @if($related->banner_image)
                                    <img src="{{ Storage::url($related->banner_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 dark:text-white group-hover:text-emerald-600 transition">{{ $related->nama_kegiatan }}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $related->tanggal->translatedFormat('d F Y') }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </x-bento.item>

            {{-- Sidebar --}}
            <div class="space-y-6 flex flex-col gap-6">
                {{-- Detail Info Card --}}
                 <x-bento.item class="!p-6 relative overflow-hidden">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                        <span class="w-1 h-5 bg-emerald-500 rounded-full"></span>
                        Detail Info
                    </h3>
                    
                    <div class="space-y-5">
                        <div class="flex gap-4 group">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shrink-0 group-hover:bg-emerald-100 dark:group-hover:bg-emerald-900/30 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Lokasi</p>
                                <p class="font-medium text-gray-900 dark:text-white leading-snug text-sm">{{ $kegiatan->lokasi ?? 'Masjid Bukit Palma' }}</p>
                            </div>
                        </div>

                        <div class="flex gap-4 group">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400 shrink-0 group-hover:bg-blue-100 dark:group-hover:bg-blue-900/30 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Pemateri</p>
                                <p class="font-medium text-gray-900 dark:text-white leading-snug text-sm">{{ $kegiatan->ustadz ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="flex gap-4 group">
                             <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-900/20 flex items-center justify-center text-purple-600 dark:text-purple-400 shrink-0 group-hover:bg-purple-100 dark:group-hover:bg-purple-900/30 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            </div>
                             <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Kategori</p>
                                <p class="font-medium text-gray-900 dark:text-white leading-snug text-sm">{{ $kegiatan->jenis_label }}</p>
                            </div>
                        </div>
                    </div>
                </x-bento.item>

                {{-- Share Card --}}
                 <x-bento.item class="!p-6 bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-slate-800 dark:to-slate-800 border-emerald-100 dark:border-white/5">
                    <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4 text-center">Bagikan Kegiatan</p>
                    <div class="grid grid-cols-2 gap-3">
                            <a href="https://wa.me/?text={{ urlencode($kegiatan->nama_kegiatan . ' - ' . url()->current()) }}" target="_blank" class="flex items-center justify-center gap-2 px-3 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-xs font-bold transition shadow-lg shadow-emerald-500/20">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                            WhatsApp
                            </a>
                            <button onclick="navigator.clipboard.writeText('{{ url()->current() }}').then(() => alert('Link berhasil disalin!'))" class="flex items-center justify-center gap-2 px-3 py-2.5 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 text-gray-700 dark:text-white rounded-xl text-xs font-bold transition border border-gray-200 dark:border-white/10">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                            Salin
                            </button>
                    </div>
                </x-bento.item>
            </div>
        </x-bento.grid>
    </div>
</x-public-layout>
