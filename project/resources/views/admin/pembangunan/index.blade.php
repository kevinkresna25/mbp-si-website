<x-admin-layout>
    <x-slot name="header">Manajemen Pembangunan</x-slot>

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Fase Pembangunan Masjid</h2>
            <p class="text-sm text-gray-500 mt-1">Progress keseluruhan: <span class="font-bold text-emerald-600">{{ $overallProgress }}%</span></p>
        </div>
        <a href="{{ route('admin.pembangunan.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition">
            + Tambah Fase
        </a>
    </div>

    {{-- Overall Progress Bar --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-gray-700">Progress Keseluruhan</span>
            <span class="text-sm font-bold text-emerald-600">{{ $overallProgress }}%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
            <div class="h-4 rounded-full transition-all duration-500 {{ $overallProgress >= 100 ? 'bg-emerald-500' : ($overallProgress >= 50 ? 'bg-emerald-400' : 'bg-yellow-400') }}"
                style="width: {{ $overallProgress }}%"></div>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Fases Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Urutan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Fase</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Progress</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Target Selesai</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Foto</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($fases as $fase)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-gray-500">{{ $fase->order_column }}</td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $fase->nama_fase }}</div>
                            @if($fase->deskripsi)
                                <p class="text-xs text-gray-400 mt-1">{{ Str::limit($fase->deskripsi, 60) }}</p>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $badgeClasses = match($fase->status) {
                                    'not_started' => 'bg-gray-100 text-gray-700',
                                    'in_progress' => 'bg-yellow-100 text-yellow-700',
                                    'completed' => 'bg-emerald-100 text-emerald-700',
                                    default => 'bg-gray-100 text-gray-700',
                                };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClasses }}">
                                {{ $fase->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-24 bg-gray-200 rounded-full h-2 overflow-hidden">
                                    @php
                                        $barColor = match(true) {
                                            $fase->progress_persen >= 100 => 'bg-emerald-500',
                                            $fase->progress_persen >= 50 => 'bg-emerald-400',
                                            $fase->progress_persen > 0 => 'bg-yellow-400',
                                            default => 'bg-gray-300',
                                        };
                                    @endphp
                                    <div class="{{ $barColor }} h-2 rounded-full transition-all" style="width: {{ $fase->progress_persen }}%"></div>
                                </div>
                                <span class="text-xs font-semibold text-gray-600">{{ $fase->progress_persen }}%</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $fase->target_selesai ? $fase->target_selesai->format('d M Y') : '-' }}
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $fase->getMedia('progress_photos')->count() }} foto
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.pembangunan.edit', $fase) }}" class="text-emerald-600 hover:text-emerald-800 font-medium">Edit</a>
                            <form method="POST" action="{{ route('admin.pembangunan.destroy', $fase) }}" class="inline" onsubmit="return confirm('Yakin hapus fase ini beserta semua fotonya?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            Belum ada data fase pembangunan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
