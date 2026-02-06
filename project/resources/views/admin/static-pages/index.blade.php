<x-admin-layout>
    <x-slot name="header">Halaman Statis</x-slot>

    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Kelola Halaman Statis</h2>
        <p class="text-sm text-gray-500 mt-1">Edit konten halaman profil masjid</p>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        @forelse($pages as $page)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ $page->title }}</h3>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600 mt-1">{{ $page->key }}</span>
                </div>
                <a href="{{ route('admin.static-pages.edit', $page) }}" class="px-3 py-1.5 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition">
                    Edit
                </a>
            </div>
            <p class="text-sm text-gray-500 mt-3">{{ \Illuminate\Support\Str::limit(strip_tags($page->content), 120) }}</p>
            @if($page->updater)
            <p class="text-xs text-gray-400 mt-3">Diupdate oleh {{ $page->updater->name }} &middot; {{ $page->updated_at->diffForHumans() }}</p>
            @endif
        </div>
        @empty
        <div class="col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
            <p class="text-gray-400">Belum ada halaman statis. Jalankan ContentSeeder untuk membuat halaman default.</p>
        </div>
        @endforelse
    </div>
</x-admin-layout>
