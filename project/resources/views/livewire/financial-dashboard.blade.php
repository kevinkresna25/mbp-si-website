<div>
    {{-- Period Selector --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
        <div class="flex flex-wrap items-center gap-4">
            <div>
                <label for="selectedMonth" class="block text-xs font-medium text-gray-500 mb-1">Bulan</label>
                <select wire:model.live="selectedMonth" id="selectedMonth"
                    class="rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                    @foreach($this->months as $num => $name)
                        <option value="{{ $num }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="selectedYear" class="block text-xs font-medium text-gray-500 mb-1">Tahun</label>
                <select wire:model.live="selectedYear" id="selectedYear"
                    class="rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                    @foreach($this->availableYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            @if(!$isPublic)
            <div class="ml-auto">
                <a href="{{ route('keuangan.laporan.pdf', ['year' => $selectedYear, 'month' => $selectedMonth]) }}" target="_blank"
                    class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Download PDF
                </a>
            </div>
            @endif
        </div>
    </div>

    {{-- Balance Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        @foreach($balances['categories'] as $cat)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="text-sm font-semibold text-gray-600">{{ $cat['label'] }}</h4>
                    @php
                        $colors = [
                            'zakat' => 'bg-blue-100 text-blue-700',
                            'infaq' => 'bg-emerald-100 text-emerald-700',
                            'sedekah' => 'bg-purple-100 text-purple-700',
                            'wakaf' => 'bg-amber-100 text-amber-700',
                            'operasional' => 'bg-gray-100 text-gray-700',
                        ];
                    @endphp
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $colors[$cat['category']] ?? 'bg-gray-100 text-gray-700' }}">
                        {{ ucfirst($cat['category']) }}
                    </span>
                </div>
                <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($cat['balance'], 0, ',', '.') }}</p>
                <div class="mt-2 flex items-center space-x-4 text-xs">
                    <span class="text-green-600">+Rp {{ number_format($cat['debit'], 0, ',', '.') }}</span>
                    <span class="text-red-600">-Rp {{ number_format($cat['credit'], 0, ',', '.') }}</span>
                </div>
            </div>
        @endforeach

        {{-- Total Balance Card --}}
        <div class="bg-emerald-700 rounded-xl shadow-sm p-5 text-white sm:col-span-2 lg:col-span-3">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-emerald-200 font-medium">Total Saldo Keseluruhan</p>
                    <p class="text-3xl font-bold mt-1">Rp {{ number_format($balances['total_balance'], 0, ',', '.') }}</p>
                </div>
                <div class="text-right text-sm">
                    <p class="text-emerald-200">Pemasukan: <span class="text-white font-semibold">Rp {{ number_format($balances['total_debit'], 0, ',', '.') }}</span></p>
                    <p class="text-emerald-200">Pengeluaran: <span class="text-white font-semibold">Rp {{ number_format($balances['total_credit'], 0, ',', '.') }}</span></p>
                </div>
            </div>
        </div>
    </div>

    {{-- Monthly Report Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">
                Laporan {{ $this->months[$selectedMonth] }} {{ $selectedYear }}
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Pemasukan</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Pengeluaran</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Saldo</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($monthlyReport['summary'] as $key => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3 text-sm font-medium text-gray-900">{{ $item['label'] }}</td>
                            <td class="px-6 py-3 text-sm text-right text-green-600">Rp {{ number_format($item['debit'], 0, ',', '.') }}</td>
                            <td class="px-6 py-3 text-sm text-right text-red-600">Rp {{ number_format($item['credit'], 0, ',', '.') }}</td>
                            <td class="px-6 py-3 text-sm text-right font-semibold text-gray-900">Rp {{ number_format($item['balance'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td class="px-6 py-3 text-sm font-bold text-gray-900">Total</td>
                        <td class="px-6 py-3 text-sm text-right font-bold text-green-600">Rp {{ number_format($monthlyReport['total_debit'], 0, ',', '.') }}</td>
                        <td class="px-6 py-3 text-sm text-right font-bold text-red-600">Rp {{ number_format($monthlyReport['total_credit'], 0, ',', '.') }}</td>
                        <td class="px-6 py-3 text-sm text-right font-bold text-gray-900">Rp {{ number_format($monthlyReport['total_debit'] - $monthlyReport['total_credit'], 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- Trends --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Tren 6 Bulan Terakhir</h3>
        </div>
        <div class="p-6">
            @php
                $maxVal = max(array_merge(array_column($trends, 'debit'), array_column($trends, 'credit'), [1]));
            @endphp
            <div class="space-y-4">
                @foreach($trends as $trend)
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700">{{ $trend['period'] }}</span>
                            <span class="text-xs text-gray-500">
                                Net: <span class="{{ $trend['net'] >= 0 ? 'text-green-600' : 'text-red-600' }} font-semibold">
                                    Rp {{ number_format($trend['net'], 0, ',', '.') }}
                                </span>
                            </span>
                        </div>
                        <div class="flex space-x-2">
                            {{-- Pemasukan bar --}}
                            <div class="flex-1">
                                <div class="bg-gray-100 rounded-full h-3 overflow-hidden">
                                    <div class="bg-emerald-500 h-3 rounded-full transition-all duration-500"
                                        style="width: {{ $maxVal > 0 ? ($trend['debit'] / $maxVal * 100) : 0 }}%"></div>
                                </div>
                            </div>
                            {{-- Pengeluaran bar --}}
                            <div class="flex-1">
                                <div class="bg-gray-100 rounded-full h-3 overflow-hidden">
                                    <div class="bg-red-400 h-3 rounded-full transition-all duration-500"
                                        style="width: {{ $maxVal > 0 ? ($trend['credit'] / $maxVal * 100) : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between text-xs text-gray-400 mt-0.5">
                            <span>Masuk: Rp {{ number_format($trend['debit'], 0, ',', '.') }}</span>
                            <span>Keluar: Rp {{ number_format($trend['credit'], 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex items-center justify-center space-x-6 mt-4 pt-4 border-t border-gray-200">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                    <span class="text-xs text-gray-600">Pemasukan</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                    <span class="text-xs text-gray-600">Pengeluaran</span>
                </div>
            </div>
        </div>
    </div>
</div>
