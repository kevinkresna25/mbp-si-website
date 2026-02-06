<x-public-layout>
    <x-slot name="title">Kelas Mengaji - Belajar Islam</x-slot>

    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-emerald-700 via-emerald-800 to-emerald-900 text-white py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center px-4 py-1.5 bg-emerald-600/50 rounded-full text-sm text-emerald-100 mb-6">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Belajar Islam
            </div>
            <h1 class="text-3xl md:text-5xl font-bold mb-4">Kelas Mengaji</h1>
            <p class="text-emerald-100 text-lg max-w-2xl mx-auto leading-relaxed">
                Program belajar Al-Quran di Masjid Bukit Palma untuk semua usia.
                Daftar sekarang melalui WhatsApp!
            </p>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Classes Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($classes as $kelas)
            @php
                $colorMap = [
                    'blue' => ['bg' => 'bg-blue-50', 'border' => 'border-blue-200', 'badge' => 'bg-blue-100 text-blue-700', 'icon_bg' => 'bg-blue-100', 'icon_text' => 'text-blue-600', 'btn' => 'bg-blue-600 hover:bg-blue-700'],
                    'emerald' => ['bg' => 'bg-emerald-50', 'border' => 'border-emerald-200', 'badge' => 'bg-emerald-100 text-emerald-700', 'icon_bg' => 'bg-emerald-100', 'icon_text' => 'text-emerald-600', 'btn' => 'bg-emerald-600 hover:bg-emerald-700'],
                    'purple' => ['bg' => 'bg-purple-50', 'border' => 'border-purple-200', 'badge' => 'bg-purple-100 text-purple-700', 'icon_bg' => 'bg-purple-100', 'icon_text' => 'text-purple-600', 'btn' => 'bg-purple-600 hover:bg-purple-700'],
                    'amber' => ['bg' => 'bg-amber-50', 'border' => 'border-amber-200', 'badge' => 'bg-amber-100 text-amber-700', 'icon_bg' => 'bg-amber-100', 'icon_text' => 'text-amber-600', 'btn' => 'bg-amber-600 hover:bg-amber-700'],
                ];
                $c = $colorMap[$kelas['color']] ?? $colorMap['emerald'];
            @endphp
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
                {{-- Card Header --}}
                <div class="{{ $c['bg'] }} {{ $c['border'] }} border-b px-6 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 {{ $c['icon_bg'] }} rounded-lg flex items-center justify-center flex-shrink-0">
                            @if($kelas['icon'] === 'book-open')
                            <svg class="w-5 h-5 {{ $c['icon_text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            @elseif($kelas['icon'] === 'academic-cap')
                            <svg class="w-5 h-5 {{ $c['icon_text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                            @elseif($kelas['icon'] === 'users')
                            <svg class="w-5 h-5 {{ $c['icon_text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            @elseif($kelas['icon'] === 'star')
                            <svg class="w-5 h-5 {{ $c['icon_text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                            @endif
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">{{ $kelas['nama'] }}</h3>
                    </div>
                </div>

                {{-- Card Body --}}
                <div class="p-6 flex-1 flex flex-col">
                    <p class="text-gray-600 text-sm leading-relaxed mb-5">{{ $kelas['deskripsi'] }}</p>

                    {{-- Schedule --}}
                    <div class="flex items-start space-x-3 mb-4">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Jadwal</p>
                            <p class="text-sm text-gray-800 font-medium">{{ $kelas['jadwal'] }}</p>
                        </div>
                    </div>

                    {{-- Teacher --}}
                    <div class="flex items-start space-x-3 mb-4">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Pengajar</p>
                            <p class="text-sm text-gray-800 font-medium">{{ $kelas['pengajar'] }}</p>
                        </div>
                    </div>

                    {{-- Requirements --}}
                    <div class="mb-6">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Persyaratan</p>
                        <ul class="space-y-1.5">
                            @foreach($kelas['persyaratan'] as $req)
                            <li class="flex items-start text-sm text-gray-600">
                                <svg class="w-4 h-4 text-emerald-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                {{ $req }}
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- WA Registration Button --}}
                    <div class="mt-auto">
                        <a href="https://wa.me/{{ $kelas['wa'] }}?text={{ urlencode('Assalamu\'alaikum, saya ingin mendaftar ' . $kelas['nama'] . ' di Masjid Bukit Palma. Mohon informasinya.') }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="flex items-center justify-center w-full px-4 py-3 {{ $c['btn'] }} text-white rounded-xl font-medium transition text-sm">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            Daftar via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- General Information --}}
        <div class="mt-10 bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Informasi Umum</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-5 bg-gray-50 rounded-xl">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-1">Lokasi</h3>
                    <p class="text-sm text-gray-600">Masjid Bukit Palma, Perumahan Bukit Palma, Surabaya</p>
                </div>
                <div class="text-center p-5 bg-gray-50 rounded-xl">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-1">Biaya</h3>
                    <p class="text-sm text-gray-600">Gratis / Infaq sukarela</p>
                </div>
                <div class="text-center p-5 bg-gray-50 rounded-xl">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-1">Pendaftaran</h3>
                    <p class="text-sm text-gray-600">Buka sepanjang tahun, langsung hubungi via WhatsApp</p>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-8">
            <a href="{{ route('belajar-islam.sholat') }}" class="inline-flex items-center text-gray-600 hover:text-emerald-600 transition text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali: Panduan Sholat
            </a>
            <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700 transition text-sm">
                Kembali ke Beranda
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            </a>
        </div>
    </section>
</x-public-layout>
