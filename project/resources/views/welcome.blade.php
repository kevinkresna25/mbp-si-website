<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Masjid Bukit Palma - Kepemudaan</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-dark-900 text-white selection:bg-brand-500 selection:text-white">
        
        <!-- Particles Background -->
        <!-- Changed to absolute + -z-10 so it sits behind everything and scrolls with the page (if full height) or stays at top -->
        <div id="tsparticles" class="absolute inset-0 -z-10 pointer-events-none"></div>

        <!-- Navbar (Temporary/Simple) -->
        <nav class="fixed w-full z-50 transition-all duration-300 backdrop-blur-md bg-dark-900/50 border-b border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex-shrink-0 flex items-center gap-3">
                        <span class="font-display font-bold text-2xl tracking-tight text-white">MBP<span class="text-brand-500">.Connect</span></span>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="relative z-10 flex items-center justify-center min-h-screen">
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center text-center">
                
                <!-- Badge -->
                <div class="animate-fade-in-up opacity-0" style="animation-delay: 0.1s;">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-brand-500/10 text-brand-400 border border-brand-500/20 backdrop-blur-sm mb-6">
                        <span class="w-2 h-2 rounded-full bg-brand-400 mr-2 animate-pulse"></span>
                        Reimagining Community
                    </span>
                </div>

                <!-- Headline -->
                <h1 class="font-display font-bold text-5xl md:text-7xl lg:text-8xl tracking-tight mb-8 animate-fade-in-up opacity-0" style="animation-delay: 0.3s;">
                    Generasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-400 to-brand-600">Muda</span>
                    <br />
                    <span class="text-white">Yang Berdaya</span>
                </h1>

                <!-- Description -->
                <p class="max-w-2xl text-lg md:text-xl text-slate-400 mb-10 leading-relaxed animate-fade-in-up opacity-0" style="animation-delay: 0.5s;">
                    Platform digital terintegrasi untuk Remaja Masjid Bukit Palma. 
                    Membangun sinergi, kreativitas, dan spiritualitas dalam satu wadah modern.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 animate-fade-in-up opacity-0" style="animation-delay: 0.7s;">
                    <a href="#" class="group relative px-8 py-4 bg-brand-600 hover:bg-brand-500 text-white font-semibold rounded-2xl transition-all duration-300 shadow-[0_0_20px_rgba(14,165,233,0.3)] hover:shadow-[0_0_30px_rgba(14,165,233,0.5)]">
                        Get Started
                        <span class="absolute inset-0 rounded-2xl ring-2 ring-white/20 group-hover:ring-white/40 transition-all"></span>
                    </a>
                    <a href="#" class="group px-8 py-4 bg-white/5 hover:bg-white/10 text-white font-semibold rounded-2xl backdrop-blur-sm border border-white/10 transition-all duration-300">
                        Learn More
                    </a>
                </div>

            </div>
            
            <!-- Gradient Overlay at bottom -->
            <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-dark-900 to-transparent pointer-events-none"></div>
        </main>

    </body>
</html>
