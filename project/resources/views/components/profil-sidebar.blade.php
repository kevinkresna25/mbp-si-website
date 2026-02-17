<x-bento.item class="!p-0 overflow-hidden">
    <div class="bg-gray-50 dark:bg-slate-700/50 p-4 border-b border-gray-100 dark:border-white/5">
        <h3 class="font-bold text-gray-900 dark:text-white">Menu Profil</h3>
    </div>
    <div class="p-2 space-y-1">
        @foreach([
            ['label' => 'Sejarah', 'url' => 'sejarah'],
            ['label' => 'Visi & Misi', 'url' => 'visi-misi'],
            ['label' => 'Struktur Organisasi', 'url' => 'struktur'],
            ['label' => 'Lokasi', 'url' => 'lokasi'],
        ] as $item)
        <a wire:navigate href="/profil/{{ $item['url'] }}" 
           class="flex items-center gap-3 px-3 py-3 rounded-xl transition font-medium {{ request()->is('profil/'.$item['url']) ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 font-bold shadow-sm' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700/50 hover:text-emerald-600 dark:hover:text-emerald-400' }}">
            <div class="w-2 h-2 rounded-full transition-colors {{ request()->is('profil/'.$item['url']) ? 'bg-emerald-500 ring-2 ring-emerald-200 dark:ring-emerald-900' : 'bg-gray-300 dark:bg-gray-600 group-hover:bg-emerald-400' }}"></div> 
            {{ $item['label'] }}
        </a>
        @endforeach
    </div>
</x-bento.item>
