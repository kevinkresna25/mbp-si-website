@props(['title', 'links'])

<x-bento.item class="!p-0 overflow-hidden">
    <div class="bg-gray-50 dark:bg-slate-700/50 p-4 border-b border-gray-100 dark:border-white/5">
        <h3 class="font-bold text-gray-900 dark:text-white">{{ $title }}</h3>
    </div>
    <div class="p-2 space-y-1">
        @foreach($links as $link)
        <a wire:navigate href="{{ $link['url'] }}" 
           class="flex items-center gap-3 px-3 py-3 rounded-xl transition font-medium {{ request()->is(trim($link['url'], '/')) || request()->url() == url($link['url']) ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700/50' }}">
            <div class="w-2 h-2 rounded-full {{ $link['color'] ?? 'bg-emerald-500' }} {{ request()->is(trim($link['url'], '/')) || request()->url() == url($link['url']) ? '' : 'opacity-50' }}"></div> 
            {{ $link['label'] }}
        </a>
        @endforeach
    </div>
</x-bento.item>
