<x-public-layout>
    <x-page-header title="Kelas Mengaji" subtitle="Program belajar Al-Quran di Masjid Bukit Palma untuk semua usia" breadcrumb="Belajar Islam / Mengaji" />

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <x-bento.grid>
            {{-- Content --}}
            <x-bento.item span="2" class="space-y-8">
                 <div class="prose prose-emerald dark:prose-invert max-w-none">
                     <p class="lead">Masjid Bukit Palma menyelenggarakan program pendidikan Al-Quran yang komprehensif, mulai dari pengenalan huruf hijaiyah hingga tahsin dan tahfidz.</p>
                 </div>

                 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($classes as $kelas)
                    @php
                        $colorMap = [
                            'blue' => ['bg' => 'bg-blue-50 dark:bg-blue-900/20', 'border' => 'border-blue-200 dark:border-blue-500/20', 'icon_text' => 'text-blue-600 dark:text-blue-400', 'btn' => 'bg-blue-600 hover:bg-blue-700'],
                            'emerald' => ['bg' => 'bg-emerald-50 dark:bg-emerald-900/20', 'border' => 'border-emerald-200 dark:border-emerald-500/20', 'icon_text' => 'text-emerald-600 dark:text-emerald-400', 'btn' => 'bg-emerald-600 hover:bg-emerald-700'],
                            'purple' => ['bg' => 'bg-purple-50 dark:bg-purple-900/20', 'border' => 'border-purple-200 dark:border-purple-500/20', 'icon_text' => 'text-purple-600 dark:text-purple-400', 'btn' => 'bg-purple-600 hover:bg-purple-700'],
                            'amber' => ['bg' => 'bg-amber-50 dark:bg-amber-900/20', 'border' => 'border-amber-200 dark:border-amber-500/20', 'icon_text' => 'text-amber-600 dark:text-amber-400', 'btn' => 'bg-amber-600 hover:bg-amber-700'],
                        ];
                        $c = $colorMap[$kelas['color']] ?? $colorMap['emerald'];
                    @endphp
                    <div class="bg-gray-50 dark:bg-slate-700/50 rounded-2xl border {{ $c['border'] }} overflow-hidden flex flex-col hover:shadow-lg transition">
                        <div class="{{ $c['bg'] }} px-6 py-5 border-b {{ $c['border'] }}">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-3">
                                <span class="{{ $c['icon_text'] }}">
                                    @if($kelas['icon'] === 'book-open')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    @elseif($kelas['icon'] === 'academic-cap')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                                    @elseif($kelas['icon'] === 'users')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                    @else
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                    @endif
                                </span>
                                {{ $kelas['nama'] }}
                            </h3>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-6">{{ $kelas['deskripsi'] }}</p>
                            
                            <div class="space-y-3 mb-6">
                                <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                                    <span class="w-20 text-xs text-gray-400 uppercase font-bold tracking-wider">Jadwal</span>
                                    <span>{{ $kelas['jadwal'] }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                                    <span class="w-20 text-xs text-gray-400 uppercase font-bold tracking-wider">Pengajar</span>
                                    <span>{{ $kelas['pengajar'] }}</span>
                                </div>
                            </div>

                            <a href="https://wa.me/{{ $kelas['wa'] }}" target="_blank"
                               class="mt-auto w-full px-4 py-3 {{ $c['btn'] }} text-white text-sm font-bold rounded-xl text-center shadow-md transition">
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>
                    @endforeach
                 </div>
            </x-bento.item>

            {{-- Sidebar --}}
            <div class="space-y-6">
                 <x-sidebar-menu title="Belajar Islam" :links="[
                    ['label' => 'Syahadat & Iman', 'url' => '/belajar-islam/syahadat', 'color' => 'bg-emerald-500'],
                    ['label' => 'Panduan Sholat', 'url' => '/belajar-islam/sholat', 'color' => 'bg-blue-500'],
                    ['label' => 'Kelas Mengaji', 'url' => '/belajar-islam/mengaji', 'color' => 'bg-purple-500'],
                ]" />

                <x-bento.item class="bg-gradient-to-br from-emerald-600 to-emerald-800 text-white !border-0 text-center">
                    <h3 class="font-bold text-lg mb-2">Mari Belajar Bersama</h3>
                    <p class="text-sm text-emerald-100 mb-4 opacity-90">"Barangsiapa menempuh jalan untuk mencari ilmu, maka Allah akan mudahkan baginya jalan menuju surga."</p>
                    <div class="inline-block px-3 py-1 bg-white/20 rounded-lg text-xs backdrop-blur-sm">HR. Muslim</div>
                </x-bento.item>
            </div>
        </x-bento.grid>
    </section>
</x-public-layout>
