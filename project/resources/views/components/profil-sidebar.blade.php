<div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-lg shadow-gray-200/50 dark:shadow-none border border-emerald-200 dark:border-emerald-500/20">
    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        Menu Profil
    </h3>
    <nav class="space-y-2">
        @foreach([
            ['label' => 'Sejarah', 'route' => 'profil.sejarah', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['label' => 'Visi & Misi', 'route' => 'profil.visi-misi', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
            ['label' => 'Struktur Organisasi', 'route' => 'profil.struktur', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
            ['label' => 'Lokasi', 'route' => 'profil.lokasi', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z'],
        ] as $item)
        <a wire:navigate href="{{ route($item['route']) }}" 
           class="flex items-center justify-between p-4 rounded-xl transition-all duration-300 border {{ request()->routeIs($item['route']) ? 'bg-emerald-500 text-white shadow-emerald-500/30 shadow-lg border-emerald-500' : 'bg-gray-50 dark:bg-slate-700/30 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-slate-700 hover:text-emerald-600 dark:hover:text-emerald-400 border-gray-200 dark:border-white/5' }}">
            <span class="font-bold text-sm">{{ $item['label'] }}</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/></svg>
        </a>
        @endforeach
    </nav>
</div>
