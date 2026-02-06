<x-admin-layout>
    <x-slot name="header">Edit Fase Pembangunan</x-slot>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Form --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Fase</h3>
                <form method="POST" action="{{ route('admin.pembangunan.update', $pembangunan) }}">
                    @csrf
                    @method('PUT')

                    <div class="space-y-5">
                        <div>
                            <label for="nama_fase" class="block text-sm font-medium text-gray-700 mb-1">Nama Fase <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_fase" id="nama_fase" value="{{ old('nama_fase', $pembangunan->nama_fase) }}" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                            @error('nama_fase') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('deskripsi', $pembangunan->deskripsi) }}</textarea>
                            @error('deskripsi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                                <select name="status" id="status" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                    <option value="not_started" {{ old('status', $pembangunan->status) === 'not_started' ? 'selected' : '' }}>Belum Dimulai</option>
                                    <option value="in_progress" {{ old('status', $pembangunan->status) === 'in_progress' ? 'selected' : '' }}>Sedang Berjalan</option>
                                    <option value="completed" {{ old('status', $pembangunan->status) === 'completed' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="target_selesai" class="block text-sm font-medium text-gray-700 mb-1">Target Selesai</label>
                                <input type="date" name="target_selesai" id="target_selesai"
                                    value="{{ old('target_selesai', $pembangunan->target_selesai?->format('Y-m-d')) }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                @error('target_selesai') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="progress_persen" class="block text-sm font-medium text-gray-700 mb-1">Progress</label>
                            <div class="flex items-center space-x-4">
                                <input type="range" name="progress_persen" id="progress_persen"
                                    min="0" max="100" step="1" value="{{ old('progress_persen', $pembangunan->progress_persen) }}"
                                    class="flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-emerald-600"
                                    oninput="document.getElementById('progress_value').textContent = this.value + '%'; document.getElementById('progress_number').value = this.value;">
                                <input type="number" id="progress_number" min="0" max="100"
                                    value="{{ old('progress_persen', $pembangunan->progress_persen) }}"
                                    class="w-20 rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm text-center"
                                    oninput="document.getElementById('progress_persen').value = this.value; document.getElementById('progress_value').textContent = this.value + '%';">
                                <span id="progress_value" class="text-sm font-bold text-emerald-600 w-12 text-right">{{ old('progress_persen', $pembangunan->progress_persen) }}%</span>
                            </div>
                            @error('progress_persen') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="order_column" class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                            <input type="number" name="order_column" id="order_column" value="{{ old('order_column', $pembangunan->order_column) }}" min="0"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                            @error('order_column') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.pembangunan.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Sidebar: Quick Info --}}
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Info Fase</h3>
                <dl class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Status</dt>
                        <dd>
                            @php
                                $badgeClasses = match($pembangunan->status) {
                                    'not_started' => 'bg-gray-100 text-gray-700',
                                    'in_progress' => 'bg-yellow-100 text-yellow-700',
                                    'completed' => 'bg-emerald-100 text-emerald-700',
                                    default => 'bg-gray-100 text-gray-700',
                                };
                            @endphp
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $badgeClasses }}">
                                {{ $pembangunan->status_label }}
                            </span>
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Progress</dt>
                        <dd class="font-semibold text-emerald-600">{{ $pembangunan->progress_persen }}%</dd>
                    </div>
                    @if($pembangunan->updater)
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Diperbarui oleh</dt>
                        <dd class="text-gray-700">{{ $pembangunan->updater->name }}</dd>
                    </div>
                    @endif
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Terakhir diubah</dt>
                        <dd class="text-gray-700">{{ $pembangunan->updated_at->format('d M Y H:i') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    {{-- Masterplan Section --}}
    <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Gambar Masterplan</h3>

        @php $masterplanMedia = $pembangunan->getMedia('masterplan'); @endphp

        @if($masterplanMedia->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-6">
                @foreach($masterplanMedia as $media)
                    <div class="relative group">
                        <img src="{{ $media->getUrl('medium') }}" alt="Masterplan" class="w-full h-40 object-cover rounded-lg">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 rounded-lg transition flex items-center justify-center">
                            <form method="POST" action="{{ route('admin.pembangunan.delete-media', [$pembangunan, $media->id]) }}"
                                class="opacity-0 group-hover:opacity-100 transition" onsubmit="return confirm('Hapus gambar ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-400 mb-4">Belum ada gambar masterplan.</p>
        @endif

        <form method="POST" action="{{ route('admin.pembangunan.upload-masterplan', $pembangunan) }}" enctype="multipart/form-data">
            @csrf
            <div class="flex items-end space-x-3">
                <div class="flex-1">
                    <label for="masterplan" class="block text-sm font-medium text-gray-700 mb-1">Upload Masterplan</label>
                    <input type="file" name="masterplan[]" id="masterplan" multiple accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    <p class="mt-1 text-xs text-gray-400">Format: JPEG, PNG, WebP. Maks 10MB per file.</p>
                </div>
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition whitespace-nowrap">
                    Upload
                </button>
            </div>
            @error('masterplan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            @error('masterplan.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </form>
    </div>

    {{-- Progress Photos Section --}}
    <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Foto Progress Pembangunan</h3>

        @php $progressPhotos = $pembangunan->getMedia('progress_photos'); @endphp

        @if($progressPhotos->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-6">
                @foreach($progressPhotos as $media)
                    <div class="relative group">
                        <img src="{{ $media->getUrl('thumb') }}" alt="Progress Photo" class="w-full h-40 object-cover rounded-lg">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent rounded-b-lg p-2">
                            <p class="text-white text-xs">{{ $media->created_at->format('d M Y') }}</p>
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 rounded-lg transition flex items-center justify-center">
                            <form method="POST" action="{{ route('admin.pembangunan.delete-media', [$pembangunan, $media->id]) }}"
                                class="opacity-0 group-hover:opacity-100 transition" onsubmit="return confirm('Hapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-400 mb-4">Belum ada foto progress.</p>
        @endif

        <form method="POST" action="{{ route('admin.pembangunan.upload-photos', $pembangunan) }}" enctype="multipart/form-data">
            @csrf
            <div class="flex items-end space-x-3">
                <div class="flex-1">
                    <label for="photos" class="block text-sm font-medium text-gray-700 mb-1">Upload Foto Progress</label>
                    <input type="file" name="photos[]" id="photos" multiple accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    <p class="mt-1 text-xs text-gray-400">Format: JPEG, PNG, WebP. Maks 5MB per file. Dapat memilih beberapa file.</p>
                </div>
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition whitespace-nowrap">
                    Upload
                </button>
            </div>
            @error('photos') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            @error('photos.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </form>
    </div>
</x-admin-layout>
