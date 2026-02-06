<x-public-layout>
    <x-slot name="title">Syahadat - Belajar Islam</x-slot>

    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-emerald-700 via-emerald-800 to-emerald-900 text-white py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center px-4 py-1.5 bg-emerald-600/50 rounded-full text-sm text-emerald-100 mb-6">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Belajar Islam
            </div>
            <h1 class="text-3xl md:text-5xl font-bold mb-4">Dua Kalimat Syahadat</h1>
            <p class="text-emerald-100 text-lg max-w-2xl mx-auto leading-relaxed">
                Rukun Islam yang pertama dan pintu gerbang memasuki agama Islam.
                Syahadat adalah persaksian yang menjadi fondasi keimanan seorang Muslim.
            </p>
        </div>
    </section>

    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-10">

        {{-- Syahadat Pertama --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-emerald-50 border-b border-emerald-100 px-6 py-4">
                <div class="flex items-center space-x-3">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-600 text-white text-sm font-bold">1</span>
                    <h2 class="text-lg font-bold text-emerald-800">Syahadat Tauhid</h2>
                </div>
            </div>
            <div class="p-6 md:p-8 space-y-6">
                {{-- Arabic Text --}}
                <div class="text-center py-6 bg-gray-50 rounded-xl">
                    <p class="font-arabic text-4xl md:text-5xl leading-[1.8] text-gray-900 px-4" dir="rtl">
                        أَشْهَدُ أَنْ لَا إِلٰهَ إِلَّا اللَّهُ
                    </p>
                </div>

                {{-- Transliteration --}}
                <div class="bg-emerald-50 rounded-xl p-5">
                    <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mb-2">Transliterasi Latin</p>
                    <p class="text-xl md:text-2xl font-medium text-emerald-900 italic">
                        Asyhadu an laa ilaaha illallah
                    </p>
                </div>

                {{-- Meaning --}}
                <div class="bg-amber-50 rounded-xl p-5">
                    <p class="text-xs font-semibold text-amber-600 uppercase tracking-wider mb-2">Arti dalam Bahasa Indonesia</p>
                    <p class="text-lg text-amber-900 font-medium">
                        "Aku bersaksi bahwa tiada Tuhan (yang berhak disembah) selain Allah"
                    </p>
                </div>

                {{-- Explanation --}}
                <div class="prose prose-emerald max-w-none">
                    <h3 class="text-base font-bold text-gray-800 mb-3">Penjelasan</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Syahadat Tauhid adalah pengakuan bahwa hanya Allah SWT satu-satunya Tuhan yang berhak disembah.
                        Tidak ada sekutu bagi-Nya. Ini adalah inti dari ajaran tauhid dalam Islam &mdash; mengesakan Allah
                        dalam ibadah, doa, dan segala bentuk pengabdian. Dengan mengucapkan syahadat ini, seorang Muslim
                        berjanji untuk mengesakan Allah dalam seluruh aspek kehidupannya.
                    </p>
                </div>
            </div>
        </div>

        {{-- Syahadat Kedua --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-emerald-50 border-b border-emerald-100 px-6 py-4">
                <div class="flex items-center space-x-3">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-600 text-white text-sm font-bold">2</span>
                    <h2 class="text-lg font-bold text-emerald-800">Syahadat Rasul</h2>
                </div>
            </div>
            <div class="p-6 md:p-8 space-y-6">
                {{-- Arabic Text --}}
                <div class="text-center py-6 bg-gray-50 rounded-xl">
                    <p class="font-arabic text-4xl md:text-5xl leading-[1.8] text-gray-900 px-4" dir="rtl">
                        وَأَشْهَدُ أَنَّ مُحَمَّدًا رَسُولُ اللَّهِ
                    </p>
                </div>

                {{-- Transliteration --}}
                <div class="bg-emerald-50 rounded-xl p-5">
                    <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mb-2">Transliterasi Latin</p>
                    <p class="text-xl md:text-2xl font-medium text-emerald-900 italic">
                        Wa asyhadu anna Muhammadan rasuulullah
                    </p>
                </div>

                {{-- Meaning --}}
                <div class="bg-amber-50 rounded-xl p-5">
                    <p class="text-xs font-semibold text-amber-600 uppercase tracking-wider mb-2">Arti dalam Bahasa Indonesia</p>
                    <p class="text-lg text-amber-900 font-medium">
                        "Dan aku bersaksi bahwa Muhammad adalah utusan Allah"
                    </p>
                </div>

                {{-- Explanation --}}
                <div class="prose prose-emerald max-w-none">
                    <h3 class="text-base font-bold text-gray-800 mb-3">Penjelasan</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Syahadat Rasul adalah pengakuan bahwa Nabi Muhammad SAW adalah utusan Allah yang terakhir.
                        Dengan mengucapkan syahadat ini, seorang Muslim berjanji untuk mengikuti ajaran, sunnah,
                        dan petunjuk yang dibawa oleh Rasulullah Muhammad SAW sebagai teladan terbaik dalam
                        menjalankan perintah Allah SWT.
                    </p>
                </div>
            </div>
        </div>

        {{-- Combined Full Syahadat --}}
        <div class="bg-gradient-to-br from-emerald-700 to-emerald-900 rounded-2xl shadow-lg p-8 md:p-10 text-white">
            <h2 class="text-xl font-bold mb-6 text-center">Dua Kalimat Syahadat (Lengkap)</h2>
            <div class="text-center space-y-4">
                <p class="font-arabic text-3xl md:text-4xl leading-[2] px-4" dir="rtl">
                    أَشْهَدُ أَنْ لَا إِلٰهَ إِلَّا اللَّهُ وَأَشْهَدُ أَنَّ مُحَمَّدًا رَسُولُ اللَّهِ
                </p>
                <div class="h-px bg-emerald-500/50 max-w-lg mx-auto"></div>
                <p class="text-lg md:text-xl italic text-emerald-100">
                    Asyhadu an laa ilaaha illallah, wa asyhadu anna Muhammadan rasuulullah
                </p>
                <p class="text-emerald-200 max-w-2xl mx-auto">
                    "Aku bersaksi bahwa tiada Tuhan selain Allah, dan aku bersaksi bahwa Muhammad adalah utusan Allah."
                </p>
            </div>
        </div>

        {{-- Importance --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Keutamaan & Kedudukan Syahadat</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex space-x-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">Rukun Islam Pertama</h3>
                        <p class="text-sm text-gray-600">Syahadat adalah rukun Islam yang pertama dan paling fundamental. Tanpa syahadat, rukun Islam lainnya tidak sah.</p>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">Kunci Surga</h3>
                        <p class="text-sm text-gray-600">Rasulullah SAW bersabda: "Kunci surga adalah laa ilaaha illallah" (HR. Ahmad). Syahadat adalah kunci keselamatan di akhirat.</p>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">Landasan Ibadah</h3>
                        <p class="text-sm text-gray-600">Seluruh ibadah dalam Islam berlandaskan pada dua kalimat syahadat. Setiap sholat mengandung bacaan syahadat dalam tasyahud.</p>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">Diucapkan Seumur Hidup</h3>
                        <p class="text-sm text-gray-600">Syahadat bukan hanya diucapkan sekali, melainkan diamalkan dan diresapi maknanya sepanjang hayat seorang Muslim.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Video Embed (Optional) --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Video Pembelajaran</h2>
            <p class="text-gray-600 mb-6">Pelajari cara pengucapan syahadat yang benar melalui video berikut:</p>
            <div class="aspect-video rounded-xl overflow-hidden bg-gray-100">
                <iframe
                    class="w-full h-full"
                    src="https://www.youtube.com/embed/GHVmaGOskbM"
                    title="Cara Mengucapkan Dua Kalimat Syahadat"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    loading="lazy"
                ></iframe>
            </div>
            <p class="text-xs text-gray-400 mt-3 text-center">Video pembelajaran pengucapan syahadat dari sumber terpercaya</p>
        </div>

        {{-- Navigation --}}
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
            <a href="{{ route('home') }}" class="inline-flex items-center text-gray-600 hover:text-emerald-600 transition text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Beranda
            </a>
            <a href="{{ route('belajar-islam.sholat') }}" class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700 transition text-sm">
                Lanjut: Panduan Sholat
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </section>
</x-public-layout>
