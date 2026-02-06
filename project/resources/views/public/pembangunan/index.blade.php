<x-public-layout>
    <x-slot name="title">Progress Pembangunan Masjid</x-slot>

    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-emerald-700 to-emerald-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold">Progress Pembangunan Masjid</h1>
                <p class="mt-3 text-lg text-emerald-200 max-w-2xl mx-auto">Pantau perkembangan pembangunan Masjid Bukit Palma secara transparan. Setiap kontribusi Anda membantu mewujudkan rumah Allah yang lebih baik.</p>
            </div>

            {{-- Overall Progress --}}
            <div class="mt-10 max-w-2xl mx-auto">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-medium text-emerald-200">Progress Keseluruhan</span>
                        <span class="text-2xl font-bold text-white">{{ $overallProgress }}%</span>
                    </div>
                    <div class="w-full bg-white/20 rounded-full h-5 overflow-hidden">
                        <div class="h-5 rounded-full transition-all duration-1000 ease-out bg-gradient-to-r from-emerald-400 to-emerald-300"
                            style="width: {{ $overallProgress }}%">
                        </div>
                    </div>
                    <div class="mt-3 flex items-center justify-between text-sm text-emerald-200">
                        <span>{{ $fases->where('status', 'completed')->count() }} dari {{ $fases->count() }} fase selesai</span>
                        <span>{{ $fases->where('status', 'in_progress')->count() }} sedang berjalan</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Masterplan Section --}}
    @php
        $allMasterplan = collect();
        foreach($fases as $fase) {
            $allMasterplan = $allMasterplan->merge($fase->getMedia('masterplan'));
        }
    @endphp

    @if($allMasterplan->count() > 0)
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Masterplan Pembangunan</h2>
                <p class="mt-2 text-gray-500">Rancangan dan desain pembangunan masjid</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($allMasterplan as $media)
                    <div class="group relative overflow-hidden rounded-xl shadow-lg">
                        <img src="{{ $media->getUrl('medium') }}" alt="Masterplan" class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                            <div class="absolute bottom-4 left-4">
                                <p class="text-white text-sm font-medium">{{ $media->model->nama_fase ?? 'Masterplan' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Construction Phases --}}
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-900">Tahapan Pembangunan</h2>
                <p class="mt-2 text-gray-500">Detail progress setiap fase pembangunan masjid</p>
            </div>

            @if($fases->isEmpty())
                <div class="text-center py-16 text-gray-400">
                    <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <p class="text-lg">Belum ada data fase pembangunan.</p>
                </div>
            @else
                <div class="space-y-8">
                    @foreach($fases as $index => $fase)
                        @php
                            $statusColors = match($fase->status) {
                                'not_started' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'border' => 'border-gray-300', 'dot' => 'bg-gray-400'],
                                'in_progress' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-700', 'border' => 'border-yellow-300', 'dot' => 'bg-yellow-400'],
                                'completed' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-300', 'dot' => 'bg-emerald-500'],
                                default => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'border' => 'border-gray-300', 'dot' => 'bg-gray-400'],
                            };
                            $progressBarColor = match(true) {
                                $fase->progress_persen >= 100 => 'from-emerald-500 to-emerald-400',
                                $fase->progress_persen >= 50 => 'from-emerald-400 to-emerald-300',
                                $fase->progress_persen > 0 => 'from-yellow-400 to-yellow-300',
                                default => 'from-gray-300 to-gray-200',
                            };
                            $fasePhotos = $fase->getMedia('progress_photos');
                        @endphp

                        <div class="bg-white rounded-2xl shadow-md border {{ $statusColors['border'] }} overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="p-6 md:p-8">
                                {{-- Header --}}
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex items-center justify-center w-10 h-10 rounded-full {{ $statusColors['bg'] }}">
                                            @if($fase->status === 'completed')
                                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            @elseif($fase->status === 'in_progress')
                                                <svg class="w-5 h-5 text-yellow-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                                </svg>
                                            @else
                                                <span class="text-sm font-bold text-gray-500">{{ $index + 1 }}</span>
                                            @endif
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-900">{{ $fase->nama_fase }}</h3>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors['bg'] }} {{ $statusColors['text'] }}">
                                            <span class="w-2 h-2 rounded-full {{ $statusColors['dot'] }} mr-1.5"></span>
                                            {{ $fase->status_label }}
                                        </span>
                                        @if($fase->target_selesai)
                                            <span class="text-sm text-gray-400">
                                                Target: {{ $fase->target_selesai->format('d M Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Description --}}
                                @if($fase->deskripsi)
                                    <p class="text-gray-600 mb-5 leading-relaxed">{{ $fase->deskripsi }}</p>
                                @endif

                                {{-- Progress Bar --}}
                                <div class="mb-6">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-500">Progress</span>
                                        <span class="text-lg font-bold {{ $fase->progress_persen >= 100 ? 'text-emerald-600' : ($fase->progress_persen > 0 ? 'text-emerald-500' : 'text-gray-400') }}">
                                            {{ $fase->progress_persen }}%
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                                        <div class="bg-gradient-to-r {{ $progressBarColor }} h-4 rounded-full transition-all duration-1000 ease-out relative"
                                            style="width: {{ $fase->progress_persen }}%">
                                            @if($fase->progress_persen > 15)
                                                <span class="absolute inset-0 flex items-center justify-center text-xs font-bold text-white drop-shadow-sm">
                                                    {{ $fase->progress_persen }}%
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Progress Photos --}}
                                @if($fasePhotos->count() > 0)
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-700 mb-3">Dokumentasi Progress ({{ $fasePhotos->count() }} foto)</h4>
                                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                            @foreach($fasePhotos->take(8) as $photo)
                                                <div class="group relative overflow-hidden rounded-lg aspect-[4/3]">
                                                    <img src="{{ $photo->getUrl('thumb') }}" alt="Progress {{ $fase->nama_fase }}"
                                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-2">
                                                        <p class="text-white text-xs">{{ $photo->created_at->format('d M Y') }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if($fasePhotos->count() > 8)
                                            <p class="text-sm text-gray-400 mt-2 text-center">+ {{ $fasePhotos->count() - 8 }} foto lainnya</p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Wakaf / Construction Fund Section --}}
    <section class="py-12 bg-gradient-to-br from-amber-50 to-emerald-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Dana Wakaf Pembangunan</h2>
                <p class="mt-2 text-gray-500">Kontribusi jamaah untuk pembangunan Masjid Bukit Palma</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="text-center p-4 bg-emerald-50 rounded-xl">
                        <p class="text-sm text-gray-500 mb-1">Total Pemasukan Wakaf</p>
                        <p class="text-xl font-bold text-emerald-700">Rp {{ number_format($wakafBalance['debit'], 0, ',', '.') }}</p>
                    </div>
                    <div class="text-center p-4 bg-amber-50 rounded-xl">
                        <p class="text-sm text-gray-500 mb-1">Pengeluaran Pembangunan</p>
                        <p class="text-xl font-bold text-amber-700">Rp {{ number_format($wakafBalance['credit'], 0, ',', '.') }}</p>
                    </div>
                    <div class="text-center p-4 bg-blue-50 rounded-xl">
                        <p class="text-sm text-gray-500 mb-1">Saldo Dana Wakaf</p>
                        <p class="text-xl font-bold text-blue-700">Rp {{ number_format($wakafBalance['balance'], 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="text-center pt-4 border-t border-gray-100">
                    <p class="text-sm text-gray-500 mb-4">Dana wakaf digunakan untuk aset jangka panjang: tanah dan bangunan masjid</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                        <a href="{{ route('keuangan.donasi') }}"
                            class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white text-sm font-semibold rounded-lg hover:bg-emerald-700 transition shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            Donasi Wakaf Sekarang
                        </a>
                        <a href="{{ route('keuangan.index') }}"
                            class="inline-flex items-center px-6 py-3 bg-white text-gray-700 text-sm font-semibold rounded-lg border border-gray-300 hover:bg-gray-50 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Lihat Laporan Keuangan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
