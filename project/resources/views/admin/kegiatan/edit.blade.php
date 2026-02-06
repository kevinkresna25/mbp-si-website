<x-admin-layout>
    <x-slot name="header">Edit Kegiatan</x-slot>

    <div class="max-w-4xl">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form action="{{ route('admin.kegiatan.update', $kegiatan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div>
                        <label for="nama_kegiatan" class="block text-sm font-medium text-gray-700 mb-1">Nama Kegiatan <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                        @error('nama_kegiatan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="jenis" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kegiatan <span class="text-red-500">*</span></label>
                            <select name="jenis" id="jenis" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                                <option value="">Pilih Jenis</option>
                                <option value="kajian" {{ old('jenis', $kegiatan->jenis) === 'kajian' ? 'selected' : '' }}>Kajian Rutin</option>
                                <option value="maulid" {{ old('jenis', $kegiatan->jenis) === 'maulid' ? 'selected' : '' }}>Hari Besar Islam</option>
                                <option value="sosial" {{ old('jenis', $kegiatan->jenis) === 'sosial' ? 'selected' : '' }}>Program Sosial</option>
                                <option value="remaja" {{ old('jenis', $kegiatan->jenis) === 'remaja' ? 'selected' : '' }}>Kegiatan Remaja</option>
                            </select>
                            @error('jenis') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                            <select name="status" id="status" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                                <option value="upcoming" {{ old('status', $kegiatan->status) === 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                                <option value="ongoing" {{ old('status', $kegiatan->status) === 'ongoing' ? 'selected' : '' }}>Berlangsung</option>
                                <option value="completed" {{ old('status', $kegiatan->status) === 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="cancelled" {{ old('status', $kegiatan->status) === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $kegiatan->tanggal->format('Y-m-d')) }}" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                            @error('tanggal') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="waktu" class="block text-sm font-medium text-gray-700 mb-1">Waktu</label>
                            <input type="time" name="waktu" id="waktu" value="{{ old('waktu', $kegiatan->waktu) }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                            @error('waktu') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                            <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $kegiatan->lokasi) }}" placeholder="Masjid Bukit Palma"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                            @error('lokasi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="ustadz" class="block text-sm font-medium text-gray-700 mb-1">Ustadz / Pemateri</label>
                            <input type="text" name="ustadz" id="ustadz" value="{{ old('ustadz', $kegiatan->ustadz) }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                            @error('ustadz') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="banner_image" class="block text-sm font-medium text-gray-700 mb-1">Banner / Poster</label>
                        @if($kegiatan->banner_image)
                        <div class="mb-2">
                            <img src="{{ Storage::url($kegiatan->banner_image) }}" alt="Banner" class="h-32 rounded-lg object-cover">
                            <p class="text-xs text-gray-400 mt-1">Banner saat ini. Upload baru untuk mengganti.</p>
                        </div>
                        @endif
                        <input type="file" name="banner_image" id="banner_image" accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                        @error('banner_image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="5" placeholder="Deskripsi kegiatan..."
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                        @error('deskripsi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-6 flex items-center space-x-3">
                    <button type="submit" class="px-5 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition">Perbarui Kegiatan</button>
                    <a href="{{ route('admin.kegiatan.index') }}" class="px-5 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
