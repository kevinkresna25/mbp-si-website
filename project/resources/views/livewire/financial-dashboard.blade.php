<div>
    {{-- Period Selector --}}
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-white/5 p-4 mb-6">
        <div class="flex flex-wrap items-center gap-4">
            <div>
                <label for="selectedMonth" class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Bulan</label>
                <select wire:model.live="selectedMonth" id="selectedMonth"
                    class="rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-700 text-gray-900 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                    @foreach($this->months as $num => $name)
                        <option value="{{ $num }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="selectedYear" class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tahun</label>
                <select wire:model.live="selectedYear" id="selectedYear"
                    class="rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-700 text-gray-900 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
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
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-white/5 p-5 transition hover:shadow-md">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-300">{{ $cat['label'] }}</h4>
                    @php
                        $colors = [
                            'zakat' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
                            'infaq' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300',
                            'sedekah' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300',
                            'wakaf' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300',
                            'operasional' => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
                        ];
                    @endphp
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $colors[$cat['category']] ?? 'bg-gray-100 text-gray-700' }}">
                        {{ ucfirst($cat['category']) }}
                    </span>
                </div>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($cat['balance'], 0, ',', '.') }}</p>
                <div class="mt-2 flex items-center space-x-4 text-xs">
                    <span class="text-green-600 dark:text-emerald-400 font-medium">+Rp {{ number_format($cat['debit'], 0, ',', '.') }}</span>
                    <span class="text-red-600 dark:text-rose-400 font-medium">-Rp {{ number_format($cat['credit'], 0, ',', '.') }}</span>
                </div>
            </div>
        @endforeach

        {{-- Total Balance Card --}}
        <div class="bg-gradient-to-br from-emerald-700 to-emerald-900 dark:from-emerald-800 dark:to-emerald-950 rounded-xl shadow-sm p-5 text-white sm:col-span-2 lg:col-span-3 relative overflow-hidden">
            {{-- Background Pattern --}}
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full blur-2xl -mr-10 -mt-10 pointer-events-none"></div>
            
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between relative z-10 gap-4">
                <div>
                    <p class="text-sm text-emerald-100 font-medium">Total Saldo Keseluruhan</p>
                    <p class="text-3xl font-bold mt-1">Rp {{ number_format($balances['total_balance'], 0, ',', '.') }}</p>
                </div>
                <div class="text-left sm:text-right text-sm space-y-1">
                    <p class="text-emerald-100">Pemasukan: <span class="text-white font-bold">Rp {{ number_format($balances['total_debit'], 0, ',', '.') }}</span></p>
                    <p class="text-emerald-100">Pengeluaran: <span class="text-white font-bold">Rp {{ number_format($balances['total_credit'], 0, ',', '.') }}</span></p>
                </div>
            </div>
        </div>
    </div>

    {{-- Monthly Report Table --}}
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-white/5 mb-6 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-white/5 bg-gray-50/50 dark:bg-slate-800/50">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                Laporan {{ $this->months[$selectedMonth] }} {{ $selectedYear }}
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-white/5">
                <thead class="bg-gray-50 dark:bg-slate-700/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pemasukan</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pengeluaran</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Saldo</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-white/5 bg-white dark:bg-slate-800">
                    @foreach($monthlyReport['summary'] as $key => $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition">
                            <td class="px-6 py-3 text-sm font-medium text-gray-900 dark:text-white">{{ $item['label'] }}</td>
                            <td class="px-6 py-3 text-sm text-right text-emerald-600 dark:text-emerald-400">Rp {{ number_format($item['debit'], 0, ',', '.') }}</td>
                            <td class="px-6 py-3 text-sm text-right text-rose-600 dark:text-rose-400">Rp {{ number_format($item['credit'], 0, ',', '.') }}</td>
                            <td class="px-6 py-3 text-sm text-right font-bold text-gray-900 dark:text-white">Rp {{ number_format($item['balance'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50 dark:bg-slate-700/50 border-t border-gray-200 dark:border-white/5">
                    <tr>
                        <td class="px-6 py-3 text-sm font-bold text-gray-900 dark:text-white">Total</td>
                        <td class="px-6 py-3 text-sm text-right font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($monthlyReport['total_debit'], 0, ',', '.') }}</td>
                        <td class="px-6 py-3 text-sm text-right font-bold text-rose-600 dark:text-rose-400">Rp {{ number_format($monthlyReport['total_credit'], 0, ',', '.') }}</td>
                        <td class="px-6 py-3 text-sm text-right font-bold text-gray-900 dark:text-white">Rp {{ number_format($monthlyReport['total_debit'] - $monthlyReport['total_credit'], 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- Trends --}}
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-white/5">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-white/5 bg-gray-50/50 dark:bg-slate-800/50">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Tren 6 Bulan Terakhir</h3>
        </div>
        <div class="p-6">
            @php
                $maxVal = max(array_merge(array_column($trends, 'debit'), array_column($trends, 'credit'), [1]));
            @endphp
            <div class="space-y-5">
                @foreach($trends as $trend)
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $trend['period'] }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 font-mono">
                                Net: <span class="{{ $trend['net'] >= 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }} font-bold">
                                    Rp {{ number_format($trend['net'], 0, ',', '.') }}
                                </span>
                            </span>
                        </div>
                        <div class="flex space-x-2 h-2.5">
                            {{-- Pemasukan bar --}}
                            <div class="flex-1 bg-gray-100 dark:bg-slate-700 rounded-full overflow-hidden">
                                <div class="bg-emerald-500 h-full rounded-full transition-all duration-500"
                                    style="width: {{ $maxVal > 0 ? ($trend['debit'] / $maxVal * 100) : 0 }}%"></div>
                            </div>
                            {{-- Pengeluaran bar --}}
                            <div class="flex-1 bg-gray-100 dark:bg-slate-700 rounded-full overflow-hidden">
                                <div class="bg-rose-400 h-full rounded-full transition-all duration-500"
                                    style="width: {{ $maxVal > 0 ? ($trend['credit'] / $maxVal * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="flex justify-between text-[10px] text-gray-400 dark:text-gray-500 mt-1 font-mono">
                            <span>Masuk: Rp {{ number_format($trend['debit'], 0, ',', '.') }}</span>
                            <span>Keluar: Rp {{ number_format($trend['credit'], 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex items-center justify-center space-x-6 mt-6 pt-6 border-t border-gray-200 dark:border-white/5">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-emerald-500 rounded-full shadow-sm"></div>
                    <span class="text-xs text-gray-600 dark:text-gray-400 font-medium">Pemasukan</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-rose-400 rounded-full shadow-sm"></div>
                    <span class="text-xs text-gray-600 dark:text-gray-400 font-medium">Pengeluaran</span>
                </div>
            </div>
        </div>
    </div>
</div>
