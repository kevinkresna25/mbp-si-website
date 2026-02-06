<x-admin-layout>
    <x-slot name="header">Edit Video Ceramah</x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form action="{{ route('admin.video-ceramah.update', $videoCeramah) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div>
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Video <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $videoCeramah->judul) }}" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                        @error('judul') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="video_url" class="block text-sm font-medium text-gray-700 mb-1">URL Video <span class="text-red-500">*</span></label>
                        <input type="url" name="video_url" id="video_url" value="{{ old('video_url', $videoCeramah->video_url) }}" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                        @error('video_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="ustadz" class="block text-sm font-medium text-gray-700 mb-1">Ustadz / Penceramah</label>
                            <input type="text" name="ustadz" id="ustadz" value="{{ old('ustadz', $videoCeramah->ustadz) }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                            @error('ustadz') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="durasi" class="block text-sm font-medium text-gray-700 mb-1">Durasi</label>
                            <input type="text" name="durasi" id="durasi" value="{{ old('durasi', $videoCeramah->durasi) }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                            @error('durasi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-1">Thumbnail</label>
                        @if($videoCeramah->thumbnail)
                        <div class="mb-2">
                            <img src="{{ Storage::url($videoCeramah->thumbnail) }}" alt="Thumbnail" class="h-24 rounded-lg object-cover">
                            <p class="text-xs text-gray-400 mt-1">Thumbnail saat ini. Upload baru untuk mengganti.</p>
                        </div>
                        @endif
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                        @error('thumbnail') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-6 flex items-center space-x-3">
                    <button type="submit" class="px-5 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition">Perbarui</button>
                    <a href="{{ route('admin.video-ceramah.index') }}" class="px-5 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
