<x-admin-layout>
    <x-slot name="header">Edit Halaman: {{ $staticPage->title }}</x-slot>

    {{-- Trix Editor Assets --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.1.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.1.8/dist/trix.umd.min.js"></script>
    <style>
        trix-editor {
            min-height: 300px;
            border-radius: 0.5rem;
            border-color: #d1d5db;
        }
        trix-editor:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }
        trix-toolbar .trix-button-group {
            border-radius: 0.375rem;
            border-color: #e5e7eb;
        }
    </style>

    <div class="max-w-3xl">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="mb-4 flex items-center space-x-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600">Key: {{ $staticPage->key }}</span>
            </div>

            <form method="POST" action="{{ route('admin.static-pages.update', $staticPage) }}">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title', $staticPage->title) }}" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Konten <span class="text-red-500">*</span></label>
                        <input id="content" type="hidden" name="content" value="{{ old('content', $staticPage->content) }}">
                        <trix-editor input="content" class="prose prose-sm max-w-none"></trix-editor>
                        @error('content') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.static-pages.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>

