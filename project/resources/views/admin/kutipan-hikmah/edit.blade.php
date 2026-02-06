<x-admin-layout>
    <x-slot name="header">Edit Kutipan Hikmah</x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form action="{{ route('admin.kutipan-hikmah.update', $kutipanHikmah) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div>
                        <label for="kutipan_text" class="block text-sm font-medium text-gray-700 mb-1">Kutipan <span class="text-red-500">*</span></label>
                        <textarea name="kutipan_text" id="kutipan_text" rows="4" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">{{ old('kutipan_text', $kutipanHikmah->kutipan_text) }}</textarea>
                        @error('kutipan_text') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="sumber" class="block text-sm font-medium text-gray-700 mb-1">Sumber</label>
                        <input type="text" name="sumber" id="sumber" value="{{ old('sumber', $kutipanHikmah->sumber) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                        @error('sumber') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $kutipanHikmah->is_active) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                        <label for="is_active" class="ml-2 text-sm text-gray-700">Aktif (tampilkan di website)</label>
                    </div>
                </div>

                <div class="mt-6 flex items-center space-x-3">
                    <button type="submit" class="px-5 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition">Perbarui</button>
                    <a href="{{ route('admin.kutipan-hikmah.index') }}" class="px-5 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
