<x-admin-layout>
    <x-slot name="header">Tambah Fase Pembangunan</x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form method="POST" action="{{ route('admin.pembangunan.store') }}">
                @csrf

                <div class="space-y-5">
                    <div>
                        <label for="nama_fase" class="block text-sm font-medium text-gray-700 mb-1">Nama Fase <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_fase" id="nama_fase" value="{{ old('nama_fase') }}" required
                            placeholder="Contoh: Pondasi, Struktur Bangunan, Atap"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        @error('nama_fase') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                            <select name="status" id="status" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                <option value="not_started" {{ old('status') === 'not_started' ? 'selected' : '' }}>Belum Dimulai</option>
                                <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>Sedang Berjalan</option>
                                <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="target_selesai" class="block text-sm font-medium text-gray-700 mb-1">Target Selesai</label>
                            <input type="date" name="target_selesai" id="target_selesai" value="{{ old('target_selesai') }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                            @error('target_selesai') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="progress_persen" class="block text-sm font-medium text-gray-700 mb-1">Progress <span class="text-red-500">*</span></label>
                        <div class="flex items-center space-x-4">
                            <input type="range" name="progress_persen" id="progress_persen"
                                min="0" max="100" step="5" value="{{ old('progress_persen', 0) }}"
                                class="flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-emerald-600"
                                oninput="document.getElementById('progress_value').textContent = this.value + '%'">
                            <span id="progress_value" class="text-sm font-bold text-emerald-600 w-12 text-right">{{ old('progress_persen', 0) }}%</span>
                        </div>
                        @error('progress_persen') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="order_column" class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                        <input type="number" name="order_column" id="order_column" value="{{ old('order_column', 0) }}" min="0"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        @error('order_column') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.pembangunan.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
