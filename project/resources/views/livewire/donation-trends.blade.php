<div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-800">Tren Keuangan {{ $months }} Bulan Terakhir</h3>
            <div class="flex items-center space-x-2">
                <button wire:click="$set('months', 6)"
                    class="px-3 py-1 text-xs font-medium rounded-lg transition {{ $months === 6 ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    6 Bulan
                </button>
                <button wire:click="$set('months', 12)"
                    class="px-3 py-1 text-xs font-medium rounded-lg transition {{ $months === 12 ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    12 Bulan
                </button>
            </div>
        </div>

        <div class="p-6">
            @php
                $maxVal = max(array_merge(array_column($trends, 'debit'), array_column($trends, 'credit'), [1]));
            @endphp

            {{-- Bar Chart --}}
            <div class="flex items-end space-x-2 md:space-x-4" style="min-height: 220px;">
                @foreach($trends as $index => $trend)
                <div class="flex-1 flex flex-col items-center" x-data="{ showTooltip: false }">
                    {{-- Tooltip --}}
                    <div x-show="showTooltip"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute -top-2 transform -translate-y-full bg-gray-800 text-white text-xs rounded-lg p-2.5 shadow-lg z-10 whitespace-nowrap pointer-events-none">
                        <p class="font-semibold mb-1">{{ $trend['period'] }}</p>
                        <p class="text-emerald-300">Masuk: Rp {{ number_format($trend['debit'], 0, ',', '.') }}</p>
                        <p class="text-red-300">Keluar: Rp {{ number_format($trend['credit'], 0, ',', '.') }}</p>
                        <p class="border-t border-gray-600 mt-1 pt-1 {{ $trend['net'] >= 0 ? 'text-emerald-300' : 'text-red-300' }}">
                            Net: Rp {{ number_format($trend['net'], 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- Bars Container --}}
                    <div class="w-full flex items-end justify-center space-x-1 relative"
                         style="height: 180px;"
                         @mouseenter="showTooltip = true"
                         @mouseleave="showTooltip = false">
                        {{-- Pemasukan Bar (Green) --}}
                        <div class="w-1/2 bg-emerald-500 rounded-t-md transition-all duration-700 ease-out hover:bg-emerald-400"
                             style="height: {{ $maxVal > 0 ? max(($trend['debit'] / $maxVal * 100), 2) : 2 }}%;">
                        </div>
                        {{-- Pengeluaran Bar (Red) --}}
                        <div class="w-1/2 bg-red-400 rounded-t-md transition-all duration-700 ease-out hover:bg-red-300"
                             style="height: {{ $maxVal > 0 ? max(($trend['credit'] / $maxVal * 100), 2) : 2 }}%;">
                        </div>
                    </div>

                    {{-- Month Label --}}
                    <div class="mt-2 text-center">
                        <p class="text-xs text-gray-500 font-medium leading-tight">{{ $trend['period'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Legend --}}
            <div class="flex items-center justify-center space-x-6 mt-6 pt-4 border-t border-gray-200">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-emerald-500 rounded-sm"></div>
                    <span class="text-xs text-gray-600">Pemasukan</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-red-400 rounded-sm"></div>
                    <span class="text-xs text-gray-600">Pengeluaran</span>
                </div>
            </div>
        </div>
    </div>
</div>
