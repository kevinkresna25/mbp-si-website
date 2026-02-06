<div>
    @if($targets->isNotEmpty())
    <div class="space-y-4">
        @foreach($targets as $target)
        @php
            $progress = $target->progress_percent;
            $colors = [
                'zakat' => ['badge' => 'bg-blue-100 text-blue-700', 'bar' => 'bg-blue-500'],
                'infaq' => ['badge' => 'bg-emerald-100 text-emerald-700', 'bar' => 'bg-emerald-500'],
                'sedekah' => ['badge' => 'bg-purple-100 text-purple-700', 'bar' => 'bg-purple-500'],
                'wakaf' => ['badge' => 'bg-amber-100 text-amber-700', 'bar' => 'bg-amber-500'],
                'operasional' => ['badge' => 'bg-gray-100 text-gray-700', 'bar' => 'bg-gray-500'],
            ];
            $color = $colors[$target->category_ziswaf?->value ?? 'infaq'] ?? $colors['infaq'];
        @endphp
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition">
            <div class="flex items-start justify-between mb-3">
                <div class="flex-1 min-w-0">
                    <h4 class="text-base font-semibold text-gray-900 truncate">{{ $target->name }}</h4>
                    @if($target->description)
                    <p class="text-sm text-gray-500 mt-0.5 line-clamp-1">{{ $target->description }}</p>
                    @endif
                </div>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $color['badge'] }} ml-3 flex-shrink-0">
                    {{ $target->category_ziswaf?->label() ?? 'Infaq' }}
                </span>
            </div>

            {{-- Progress Bar --}}
            <div class="relative mb-3">
                <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                    <div class="{{ $color['bar'] }} h-3 rounded-full transition-all duration-700 ease-out"
                         style="width: {{ $progress }}%"></div>
                </div>
            </div>

            {{-- Stats --}}
            <div class="flex items-center justify-between">
                <div class="text-sm">
                    <span class="font-semibold text-gray-900">Rp {{ number_format($target->current_amount, 0, ',', '.') }}</span>
                    <span class="text-gray-400 mx-1">/</span>
                    <span class="text-gray-500">Rp {{ number_format($target->target_amount, 0, ',', '.') }}</span>
                </div>
                <span class="text-sm font-bold {{ $progress >= 100 ? 'text-emerald-600' : 'text-gray-700' }}">
                    {{ $progress }}%
                </span>
            </div>

            {{-- Donate Button --}}
            <a href="{{ route('keuangan.donasi') }}"
               class="mt-4 flex items-center justify-center w-full px-4 py-2.5 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                Donasi Sekarang
            </a>
        </div>
        @endforeach
    </div>
    @else
    <div class="bg-gray-50 rounded-xl p-8 text-center">
        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
        <p class="text-gray-500 text-sm">Belum ada target donasi aktif saat ini.</p>
    </div>
    @endif
</div>
