<x-public-layout>
    <x-page-header title="Progress Pembangunan" subtitle="Pantau perkembangan pembangunan Masjid Bukit Palma secara transparan. Setiap kontribusi Anda membantu mewujudkan rumah Allah yang lebih baik." breadcrumb="Pembangunan" />

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Overall Progress --}}
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg p-8 mb-12 border border-gray-100 dark:border-white/5 relative overflow-hidden">
             <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/5 to-emerald-500/10 pointer-events-none"></div>
             <div class="relative z-10 max-w-3xl mx-auto text-center">
                 <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Progress Keseluruhan</h2>
                 <div class="flex items-center justify-between mb-2 px-2">
                     <span class="text-sm font-medium text-emerald-600 dark:text-emerald-400">Total Pencapaian</span>
                     <span class="text-2xl font-black text-gray-900 dark:text-white">{{ $overallProgress }}%</span>
                 </div>
                 <div class="w-full bg-gray-200 dark:bg-slate-700 rounded-full h-6 overflow-hidden shadow-inner">
                    <div class="h-6 rounded-full transition-all duration-1000 ease-out bg-gradient-to-r from-emerald-500 to-emerald-400 relative"
                        style="width: {{ $overallProgress }}%">
                        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/diagonal-stripes.png')] opacity-20"></div>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-center gap-6 text-sm text-gray-500 dark:text-gray-400">
                    <div class="flex items-center gap-2">
                         <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                         <span>{{ $fases->where('status', 'completed')->count() }} Selesai</span>
                    </div>
                    <div class="flex items-center gap-2">
                         <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                         <span>{{ $fases->where('status', 'in_progress')->count() }} Berjalan</span>
                    </div>
                    <div class="flex items-center gap-2">
                         <div class="w-3 h-3 rounded-full bg-gray-300 dark:bg-slate-600"></div>
                         <span>{{ $fases->where('status', 'not_started')->count() }} Belum Mulai</span>
                    </div>
                </div>
             </div>
        </div>

        {{-- Masterplan --}}
        @php
            $allMasterplan = collect();
            foreach($fases as $fase) {
                $allMasterplan = $allMasterplan->merge($fase->getMedia('masterplan'));
            }
        @endphp

        @if($allMasterplan->count() > 0)
        <div class="mb-16">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">Masterplan & Desain</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($allMasterplan as $media)
                    <div class="group relative overflow-hidden rounded-2xl shadow-md border border-gray-100 dark:border-white/5 cursor-zoom-in">
                        <img src="{{ $media->getUrl('medium') }}" alt="Masterplan" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                            <p class="text-white font-medium">{{ $media->model->nama_fase ?? 'Masterplan' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Timeline Phases --}}
        <div class="relative border-l-2 border-dashed border-gray-200 dark:border-slate-700 ml-4 md:ml-0 md:pl-0 space-y-12">
             @forelse($fases as $index => $fase)
                @php
                    $statusConfig = match($fase->status) {
                        'completed' => ['bg' => 'bg-emerald-50 dark:bg-slate-800', 'border' => 'border-emerald-200 dark:border-emerald-500/20', 'icon' => 'bg-emerald-500 text-white', 'status_bg' => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300'],
                        'in_progress' => ['bg' => 'bg-white dark:bg-slate-800', 'border' => 'border-yellow-200 dark:border-yellow-500/20', 'icon' => 'bg-yellow-400 text-white animate-pulse', 'status_bg' => 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300'],
                        default => ['bg' => 'bg-gray-50 dark:bg-slate-900/50', 'border' => 'border-gray-200 dark:border-white/5', 'icon' => 'bg-gray-300 dark:bg-slate-600 text-white', 'status_bg' => 'bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-gray-400'],
                    };
                    $fasePhotos = $fase->getMedia('progress_photos');
                @endphp

                <div class="md:grid md:grid-cols-12 md:gap-8 relative group">
                    {{-- Timeline Dot --}}
                    <div class="absolute -left-[9px] md:left-auto md:right-1/2 md:-mr-[9px] top-6 w-5 h-5 rounded-full border-4 border-white dark:border-slate-900 {{ $statusConfig['icon'] }} z-10 shadow-sm"></div>

                    {{-- Content --}}
                    <div class="md:col-span-12 ml-8 md:ml-0 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border {{ $statusConfig['border'] }} p-6 md:p-8 hover:shadow-lg transition duration-300 relative overflow-hidden">
                        @if($fase->status === 'in_progress')
                            <div class="absolute top-0 right-0 w-24 h-24 bg-yellow-400 opacity-5 rounded-bl-full -mr-4 -mt-4"></div>
                        @elseif($fase->status === 'completed')
                            <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500 opacity-5 rounded-bl-full -mr-4 -mt-4"></div>
                        @endif

                        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-6 relative z-10">
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider {{ $statusConfig['status_bg'] }}">
                                        {{ $fase->status_label }}
                                    </span>
                                    @if($fase->target_selesai)
                                        <span class="text-xs text-gray-400">Target: {{ $fase->target_selesai->format('d M Y') }}</span>
                                    @endif
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $fase->nama_fase }}</h3>
                            </div>
                            <div class="text-right">
                                <span class="block text-3xl font-black text-gray-200 dark:text-slate-700">#{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>

                        @if($fase->deskripsi)
                            <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">{{ $fase->deskripsi }}</p>
                        @endif

                        {{-- Progress Bar --}}
                         <div class="mb-8 p-4 bg-gray-50 dark:bg-slate-700/30 rounded-xl border border-gray-100 dark:border-white/5">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Progress Fase Ini</span>
                                <span class="text-lg font-bold {{ $fase->progress_persen >= 100 ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-900 dark:text-white' }}">{{ $fase->progress_persen }}%</span>
                            </div>
                             <div class="w-full bg-gray-200 dark:bg-slate-600 rounded-full h-3 overflow-hidden">
                                <div class="bg-gradient-to-r from-emerald-500 to-emerald-400 h-3 rounded-full transition-all duration-1000 ease-out"
                                    style="width: {{ $fase->progress_persen }}%"></div>
                            </div>
                        </div>

                        {{-- Documentation --}}
                        @if($fasePhotos->count() > 0)
                            <div>
                                <h4 class="text-sm font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Dokumentasi ({{ $fasePhotos->count() }} foto)
                                </h4>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                    @foreach($fasePhotos->take(4) as $photo)
                                        <div class="aspect-square rounded-lg overflow-hidden relative group/photo">
                                            <img src="{{ $photo->getUrl('thumb') }}" class="w-full h-full object-cover transition duration-500 group-hover/photo:scale-110">
                                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover/photo:opacity-100 transition flex items-center justify-center">
                                                 <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if($fasePhotos->count() > 4)
                                        <div class="aspect-square rounded-lg overflow-hidden bg-gray-100 dark:bg-slate-700 flex items-center justify-center text-gray-500 dark:text-gray-400 font-bold text-sm border border-gray-200 dark:border-white/5">
                                            +{{ $fasePhotos->count() - 4 }} Foto
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
             @empty
                <div class="text-center py-12">
                     <p class="text-gray-500 dark:text-gray-400">Belum ada data fase pembangunan.</p>
                </div>
             @endforelse
        </div>
    </section>

    {{-- Wakaf CTA --}}
    <section class="py-16 bg-gradient-to-br from-amber-50 to-orange-50 dark:from-slate-800 dark:to-slate-900 border-t border-amber-100 dark:border-white/5">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Wakaf Pembangunan</h2>
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 mb-8 border border-amber-100 dark:border-white/5">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                     <div>
                         <p class="text-sm text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wider">Pemasukan Wakaf</p>
                         <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($wakafBalance['debit'], 0, ',', '.') }}</p>
                     </div>
                     <div class="md:border-x border-gray-100 dark:border-white/10">
                         <p class="text-sm text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wider">Pengeluaran</p>
                         <p class="text-2xl font-bold text-rose-600 dark:text-rose-400">Rp {{ number_format($wakafBalance['credit'], 0, ',', '.') }}</p>
                     </div>
                     <div>
                         <p class="text-sm text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wider">Saldo Wakaf</p>
                         <p class="text-2xl font-bold text-amber-600 dark:text-amber-400">Rp {{ number_format($wakafBalance['balance'], 0, ',', '.') }}</p>
                     </div>
                </div>
            </div>
            <a href="{{ route('keuangan.donasi') }}" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-bold rounded-xl shadow-lg hover:bg-amber-600 transition hover:scale-105 duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
                Wakaf Sekarang
            </a>
        </div>
    </section>
</x-public-layout>
