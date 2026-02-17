<x-public-layout>
    <x-page-header title="Hubungi Kami" subtitle="Kami siap mendengar masukan, saran, atau pertanyaan Anda." breadcrumb="Kontak" />

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
        <div class="relative">
            {{-- Decorative Elements --}}
            <div class="absolute -top-10 -left-10 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl rounded-tr-none pointer-events-none"></div>
            <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl rounded-bl-none pointer-events-none"></div>

            <div class="relative bg-white dark:bg-slate-800 rounded-3xl shadow-xl overflow-hidden border border-gray-100 dark:border-white/5 flex flex-col lg:flex-row">
                
                {{-- Left Column: Contact Info --}}
                <div class="w-full lg:w-2/5 bg-gradient-to-br from-emerald-900 to-emerald-800 text-white p-8 lg:p-12 relative overflow-hidden">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')] opacity-10"></div>
                    <div class="absolute bottom-0 right-0 w-32 h-32 bg-emerald-500/20 rounded-full blur-2xl translate-x-10 translate-y-10"></div>

                    <div class="relative z-10 space-y-8">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Informasi Kontak</h3>
                            <p class="text-emerald-100 text-sm leading-relaxed">
                                Silakan hubungi kami melalui formulir atau kontak di bawah ini. Kami insyaAllah akan segera merespons pesan Anda.
                            </p>
                        </div>

                        {{-- Info Items --}}
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center shrink-0 backdrop-blur-sm border border-white/10">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-sm">Alamat</h4>
                                    <p class="text-emerald-100 text-xs mt-1 leading-relaxed">{{ site_setting('site_address', 'Perumahan Bukit Palma, Surabaya, Jawa Timur, Indonesia') }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center shrink-0 backdrop-blur-sm border border-white/10">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-sm">Email</h4>
                                    <p class="text-emerald-100 text-xs mt-1">info@masjidbukitpalma.com</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center shrink-0 backdrop-blur-sm border border-white/10">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-sm">Jam Operasional</h4>
                                    <div class="text-emerald-100 text-sm mt-3 space-y-2 w-full pr-4">
                                         @php
                                            $hours = site_setting('office_hours');
                                            $schedule = is_string($hours) ? json_decode($hours, true) : $hours;
                                            if (!is_array($schedule)) $schedule = [];
                                        @endphp
                                        @foreach($schedule as $slot)
                                            <div class="flex justify-between items-center w-full gap-6 border-b border-emerald-500/20 pb-2 last:border-0 last:pb-0">
                                                <span class="font-medium text-white/90">
                                                    {{ $slot['day_start'] }} 
                                                    @if(($slot['day_end'] ?? '') && ($slot['day_end'] !== $slot['day_start'])) - {{ $slot['day_end'] }} @endif
                                                </span>
                                                <span class="font-mono text-xs bg-emerald-900/40 px-2 py-1 rounded text-emerald-100 whitespace-nowrap border border-emerald-500/20">
                                                    @if(!empty($slot['is_closed']))
                                                        Tutup
                                                    @else
                                                        {{ $slot['time_open'] ?? '00:00' }} - {{ $slot['time_close'] ?? '00:00' }}
                                                    @endif
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Socials --}}
                        <div class="pt-8 border-t border-white/10">
                             <h4 class="font-bold text-white text-sm mb-4">Ikuti Kami</h4>
                             <div class="flex gap-3">
                                @foreach($socialMedia as $social)
                                <a href="{{ $social->url }}" target="_blank" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-emerald-800 transition duration-300">
                                     <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="{{ $social->getIconSvg() }}"/></svg>
                                </a>
                                @endforeach
                             </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Form --}}
                <div class="w-full lg:w-3/5 p-8 lg:p-12 bg-white dark:bg-slate-800">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Kirim Pesan</h2>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mb-8">Punya pertanyaan atau saran? Isi formulir di bawah ini.</p>

                    @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-500/30 text-emerald-700 dark:text-emerald-300 rounded-xl flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('public.kontak.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="nama" class="text-sm font-bold text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                                    class="w-full rounded-xl border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-slate-700/50 text-gray-900 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition px-4 py-3 sm:text-sm" placeholder="Nama Anda">
                                @error('nama') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="email" class="text-sm font-bold text-gray-700 dark:text-gray-300">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                    class="w-full rounded-xl border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-slate-700/50 text-gray-900 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition px-4 py-3 sm:text-sm" placeholder="email@anda.com">
                                @error('email') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="subject" class="text-sm font-bold text-gray-700 dark:text-gray-300">Subjek</label>
                            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                                class="w-full rounded-xl border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-slate-700/50 text-gray-900 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition px-4 py-3 sm:text-sm" placeholder="Topik pesan Anda">
                            @error('subject') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="pesan" class="text-sm font-bold text-gray-700 dark:text-gray-300">Pesan</label>
                            <textarea name="pesan" id="pesan" rows="4" required
                                class="w-full rounded-xl border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-slate-700/50 text-gray-900 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500 transition px-4 py-3 sm:text-sm" placeholder="Tuliskan pesan Anda di sini...">{{ old('pesan') }}</textarea>
                            @error('pesan') <p class="text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- Turnstile CAPTCHA --}}
                        <div class="dark:grayscale dark:invert origin-left transform scale-90 sm:scale-100">
                            <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
                             <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}"></div>
                            @error('cf-turnstile-response') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-500/20 flex items-center justify-center gap-2 group">
                            <span>Kirim Pesan</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Map Section (Below the Card) --}}
            <div class="mt-8 bg-white dark:bg-slate-800 rounded-3xl p-4 shadow-sm border border-gray-100 dark:border-white/5">
                <iframe
                    src="{{ site_setting('google_maps_embed', '') }}"
                    width="100%" height="300" style="border:0;" class="w-full rounded-2xl grayscale hover:grayscale-0 transition duration-700"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
            </div>
        </div>
    </section>
</x-public-layout>
