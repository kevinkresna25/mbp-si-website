@props(['title', 'subtitle' => null])

<section class="bg-emerald-900 bg-gradient-to-br from-emerald-900 to-emerald-800 text-white py-12 md:py-20 relative overflow-hidden">
    {{-- Background Decoration --}}
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')]"></div>
    <div class="absolute right-0 top-0 w-64 h-64 bg-emerald-500 rounded-full blur-3xl opacity-20 -mr-16 -mt-16 pointer-events-none"></div>
    <div class="absolute left-0 bottom-0 w-48 h-48 bg-gold-500 rounded-full blur-3xl opacity-10 -ml-16 -mb-16 pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center md:text-left">
        {{-- Breadcrumb Support Slot --}}
        @if(isset($breadcrumb))
        <nav class="flex justify-center md:justify-start mb-4 text-sm text-emerald-200">
            <a wire:navigate href="/" class="hover:text-white transition">Beranda</a>
            <span class="mx-2">/</span>
            {{ $breadcrumb }}
        </nav>
        @endif

        <h1 class="text-3xl md:text-5xl font-bold tracking-tight mb-4 leading-tight">{{ $title }}</h1>
        
        @if($subtitle)
            <p class="text-emerald-100/90 text-lg md:text-xl max-w-2xl mx-auto md:mx-0 leading-relaxed font-light">
                {{ $subtitle }}
            </p>
        @endif

        {{ $slot }}
    </div>
</section>
