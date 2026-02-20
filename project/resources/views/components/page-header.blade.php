@props(['title', 'subtitle' => null, 'breadcrumb' => null])
<section class="relative overflow-hidden pt-24 pb-6 lg:pt-32 lg:pb-10">
    {{-- Background Decorations (Zen Theme) --}}
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute -top-[20%] -right-[10%] w-[70%] h-[70%] rounded-full bg-gradient-to-br from-emerald-50/50 to-teal-50/50 dark:from-emerald-900/10 dark:to-teal-900/10 blur-3xl"></div>
        <div class="absolute top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-gradient-to-tr from-emerald-50/30 to-emerald-100/30 dark:from-emerald-900/5 dark:to-emerald-800/5 blur-3xl"></div>
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.03] dark:opacity-[0.05]"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        {{-- Breadcrumb (Modern Pill) --}}
        @if(isset($breadcrumb))
        <nav class="inline-flex items-center justify-center space-x-2 text-sm font-medium text-emerald-600 dark:text-emerald-400 bg-emerald-50/50 dark:bg-emerald-900/20 px-4 py-1.5 rounded-full mb-4 border border-emerald-100/50 dark:border-emerald-500/20 animate-fade-in-up backdrop-blur-sm">
            <a wire:navigate href="/" class="hover:text-emerald-800 dark:hover:text-emerald-300 transition-colors">Beranda</a>
            <svg class="w-3 h-3 text-emerald-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
            <span class="text-emerald-800 dark:text-emerald-200">{{ $breadcrumb }}</span>
        </nav>
        @endif

        {{-- Title --}}
        <h1 class="text-4xl md:text-5xl font-display font-bold text-gray-900 dark:text-white mb-2 leading-tight tracking-tight animate-fade-in-up" style="animation-delay: 0.1s;">
            {{ $title }}
        </h1>
        
        {{-- Subtitle --}}
        @if($subtitle)
            <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto leading-relaxed animate-fade-in-up" style="animation-delay: 0.2s;">
                {{ $subtitle }}
            </p>
        @endif

        {{-- Slot --}}
        <div class="mt-4 animate-fade-in-up" style="animation-delay: 0.3s;">
            {{ $slot }}
        </div>
    </div>
</section>
