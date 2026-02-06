<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class BelajarIslamController extends Controller
{
    /**
     * Syahadat - The two declarations of Islamic faith.
     */
    public function syahadat()
    {
        return view('public.belajar-islam.syahadat');
    }

    /**
     * Sholat - Step-by-step prayer guide with Arabic text, transliteration, and meaning.
     */
    public function sholat()
    {
        $steps = [
            [
                'no' => 1,
                'nama' => 'Niat',
                'arabic' => 'أُصَلِّي فَرْضَ الظُّهْرِ أَرْبَعَ رَكَعَاتٍ مُسْتَقْبِلَ الْقِبْلَةِ أَدَاءً لِلَّهِ تَعَالَى',
                'latin' => 'Ushollii fardhodh-dhuhri arba\'a roka\'aatin mustaqbilal qiblati adaa-an lillaahi ta\'aalaa.',
                'arti' => 'Saya niat sholat fardhu Dzuhur empat rakaat menghadap kiblat karena Allah Ta\'ala.',
                'catatan' => 'Niat diucapkan di dalam hati bersamaan dengan takbiratul ihram. Contoh di atas adalah niat sholat Dzuhur.',
            ],
            [
                'no' => 2,
                'nama' => 'Takbiratul Ihram',
                'arabic' => 'اللَّهُ أَكْبَرُ',
                'latin' => 'Allahu Akbar.',
                'arti' => 'Allah Maha Besar.',
                'catatan' => 'Mengangkat kedua tangan sejajar telinga, lalu meletakkannya di dada.',
            ],
            [
                'no' => 3,
                'nama' => 'Doa Iftitah',
                'arabic' => 'اللَّهُ أَكْبَرُ كَبِيرًا وَالْحَمْدُ لِلَّهِ كَثِيرًا وَسُبْحَانَ اللَّهِ بُكْرَةً وَأَصِيلًا',
                'latin' => 'Allahu akbar kabiiraa wal hamdulillaahi katsiiraa wa subhaanallaahi bukratan wa ashiilaa.',
                'arti' => 'Allah Maha Besar dengan sebesar-besarnya, segala puji bagi Allah dengan pujian yang banyak, dan Maha Suci Allah di waktu pagi dan petang.',
                'catatan' => 'Dibaca setelah takbiratul ihram sebelum membaca Al-Fatihah.',
            ],
            [
                'no' => 4,
                'nama' => 'Membaca Al-Fatihah',
                'arabic' => "بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ ﴿١﴾\nالْحَمْدُ لِلَّهِ رَبِّ الْعَالَمِينَ ﴿٢﴾\nالرَّحْمَنِ الرَّحِيمِ ﴿٣﴾\nمَالِكِ يَوْمِ الدِّينِ ﴿٤﴾\nإِيَّاكَ نَعْبُدُ وَإِيَّاكَ نَسْتَعِينُ ﴿٥﴾\nاهْدِنَا الصِّرَاطَ الْمُسْتَقِيمَ ﴿٦﴾\nصِرَاطَ الَّذِينَ أَنْعَمْتَ عَلَيْهِمْ غَيْرِ الْمَغْضُوبِ عَلَيْهِمْ وَلَا الضَّالِّينَ ﴿٧﴾",
                'latin' => "Bismillaahir-rahmaanir-rahiim. Al-hamdu lillaahi robbil 'aalamiin. Ar-rahmaanir-rahiim. Maaliki yaumid-diin. Iyyaaka na'budu wa iyyaaka nasta'iin. Ihdinash-shiraathal mustaqiim. Shiraathal ladziina an'amta 'alaihim, ghoiril maghduubi 'alaihim wa ladh-dhooolliin.",
                'arti' => 'Dengan nama Allah Yang Maha Pengasih, Maha Penyayang. Segala puji bagi Allah, Tuhan seluruh alam. Yang Maha Pengasih, Maha Penyayang. Pemilik hari pembalasan. Hanya kepada-Mu kami menyembah dan hanya kepada-Mu kami mohon pertolongan. Tunjukilah kami jalan yang lurus. Yaitu jalan orang-orang yang telah Engkau beri nikmat, bukan jalan mereka yang dimurkai, dan bukan pula jalan mereka yang sesat.',
                'catatan' => 'Wajib dibaca pada setiap rakaat. Diakhiri dengan "Aamiin".',
            ],
            [
                'no' => 5,
                'nama' => 'Ruku\'',
                'arabic' => 'سُبْحَانَ رَبِّيَ الْعَظِيمِ',
                'latin' => 'Subhaana robbiyal \'adhiim. (3x)',
                'arti' => 'Maha Suci Tuhanku Yang Maha Agung.',
                'catatan' => 'Membungkuk dengan tangan memegang lutut, punggung lurus sejajar.',
            ],
            [
                'no' => 6,
                'nama' => 'I\'tidal (Bangkit dari Ruku)',
                'arabic' => "سَمِعَ اللَّهُ لِمَنْ حَمِدَهُ\nرَبَّنَا وَلَكَ الْحَمْدُ",
                'latin' => "Sami'allaahu liman hamidah. Robbanaa wa lakal hamd.",
                'arti' => 'Allah mendengar pujian orang yang memuji-Nya. Ya Tuhan kami, bagi-Mu segala puji.',
                'catatan' => 'Berdiri tegak kembali dari posisi ruku\'.',
            ],
            [
                'no' => 7,
                'nama' => 'Sujud',
                'arabic' => 'سُبْحَانَ رَبِّيَ الْأَعْلَى',
                'latin' => 'Subhaana robbiyal a\'laa. (3x)',
                'arti' => 'Maha Suci Tuhanku Yang Maha Tinggi.',
                'catatan' => 'Meletakkan 7 anggota badan: dahi & hidung, kedua telapak tangan, kedua lutut, dan ujung kedua kaki.',
            ],
            [
                'no' => 8,
                'nama' => 'Duduk Antara Dua Sujud',
                'arabic' => 'رَبِّ اغْفِرْ لِي وَارْحَمْنِي وَاجْبُرْنِي وَارْفَعْنِي وَارْزُقْنِي وَاهْدِنِي وَعَافِنِي وَاعْفُ عَنِّي',
                'latin' => 'Robbighfirlii warhamnii wajburnii warfa\'nii warzuqnii wahdinii wa \'aafinii wa\'fu \'annii.',
                'arti' => 'Ya Tuhanku, ampunilah aku, kasihanilah aku, cukupkanlah (kekuranganku), angkatlah (derajatku), berilah aku rizki, berilah aku petunjuk, berilah aku kesehatan, dan maafkanlah aku.',
                'catatan' => 'Duduk di antara dua sujud dengan posisi iftirasy (duduk di atas kaki kiri).',
            ],
            [
                'no' => 9,
                'nama' => 'Sujud Kedua',
                'arabic' => 'سُبْحَانَ رَبِّيَ الْأَعْلَى',
                'latin' => 'Subhaana robbiyal a\'laa. (3x)',
                'arti' => 'Maha Suci Tuhanku Yang Maha Tinggi.',
                'catatan' => 'Sama seperti sujud pertama.',
            ],
            [
                'no' => 10,
                'nama' => 'Tasyahud Awal',
                'arabic' => "التَّحِيَّاتُ الْمُبَارَكَاتُ الصَّلَوَاتُ الطَّيِّبَاتُ لِلَّهِ\nالسَّلَامُ عَلَيْكَ أَيُّهَا النَّبِيُّ وَرَحْمَةُ اللَّهِ وَبَرَكَاتُهُ\nالسَّلَامُ عَلَيْنَا وَعَلَى عِبَادِ اللَّهِ الصَّالِحِينَ\nأَشْهَدُ أَنْ لَا إِلَهَ إِلَّا اللَّهُ وَأَشْهَدُ أَنَّ مُحَمَّدًا رَسُولُ اللَّهِ",
                'latin' => "At-tahiyyaatul mubaarokaatush-sholawaatuth-thoyyibaatu lillaah. As-salaamu 'alaika ayyuhan-nabiyyu wa rahmatullaahi wa barokaatuh. As-salaamu 'alainaa wa 'alaa 'ibaadillaahish-shoolihiin. Asyhadu an laa ilaaha illallaah wa asyhadu anna Muhammadan rosuulullaah.",
                'arti' => 'Segala penghormatan, keberkahan, shalawat dan kebaikan hanya bagi Allah. Semoga keselamatan, rahmat Allah, dan berkah-Nya tercurah kepadamu wahai Nabi. Semoga keselamatan tercurah kepada kami dan kepada hamba-hamba Allah yang sholeh. Aku bersaksi bahwa tiada Tuhan selain Allah dan aku bersaksi bahwa Muhammad adalah utusan Allah.',
                'catatan' => 'Dibaca pada rakaat kedua. Telunjuk kanan diangkat saat mengucapkan syahadat.',
            ],
            [
                'no' => 11,
                'nama' => 'Tasyahud Akhir & Sholawat',
                'arabic' => "اللَّهُمَّ صَلِّ عَلَى مُحَمَّدٍ وَعَلَى آلِ مُحَمَّدٍ\nكَمَا صَلَّيْتَ عَلَى إِبْرَاهِيمَ وَعَلَى آلِ إِبْرَاهِيمَ\nوَبَارِكْ عَلَى مُحَمَّدٍ وَعَلَى آلِ مُحَمَّدٍ\nكَمَا بَارَكْتَ عَلَى إِبْرَاهِيمَ وَعَلَى آلِ إِبْرَاهِيمَ\nفِي الْعَالَمِينَ إِنَّكَ حَمِيدٌ مَجِيدٌ",
                'latin' => "Allaahumma sholli 'alaa Muhammad wa 'alaa aali Muhammad. Kamaa shollaita 'alaa Ibraahiim wa 'alaa aali Ibraahiim. Wa baarik 'alaa Muhammad wa 'alaa aali Muhammad. Kamaa baarokta 'alaa Ibraahiim wa 'alaa aali Ibraahiim. Fil 'aalamiina innaka hamiidum-majiid.",
                'arti' => 'Ya Allah, limpahkanlah shalawat kepada Muhammad dan kepada keluarga Muhammad, sebagaimana Engkau melimpahkan shalawat kepada Ibrahim dan kepada keluarga Ibrahim. Dan berkahilah Muhammad dan keluarga Muhammad, sebagaimana Engkau memberkahi Ibrahim dan keluarga Ibrahim. Di seluruh alam, sesungguhnya Engkau Maha Terpuji lagi Maha Mulia.',
                'catatan' => 'Dibaca pada rakaat terakhir, setelah tasyahud awal. Dilanjutkan dengan doa sebelum salam.',
            ],
            [
                'no' => 12,
                'nama' => 'Salam',
                'arabic' => 'السَّلَامُ عَلَيْكُمْ وَرَحْمَةُ اللَّهِ',
                'latin' => "As-salaamu 'alaikum wa rahmatullaah.",
                'arti' => 'Semoga keselamatan dan rahmat Allah tercurah kepadamu.',
                'catatan' => 'Menoleh ke kanan dan ke kiri. Salam mengakhiri sholat.',
            ],
        ];

        return view('public.belajar-islam.sholat', compact('steps'));
    }

    /**
     * Mengaji - Quran learning class information with WA registration.
     */
    public function mengaji()
    {
        $classes = [
            [
                'nama' => 'Kelas Iqra (Pemula)',
                'deskripsi' => 'Program belajar membaca Al-Quran dari dasar menggunakan metode Iqra untuk anak-anak dan dewasa yang belum bisa membaca huruf hijaiyyah.',
                'jadwal' => 'Senin & Rabu, 16:00 - 17:30 WIB',
                'persyaratan' => ['Usia minimal 5 tahun', 'Bersedia hadir rutin minimal 2x seminggu', 'Membawa buku Iqra sendiri'],
                'pengajar' => 'Ust. Ahmad Fadli',
                'wa' => '6281234567890',
                'icon' => 'book-open',
                'color' => 'blue',
            ],
            [
                'nama' => 'Kelas Anak-anak',
                'deskripsi' => 'Program mengaji untuk anak-anak dengan pembelajaran yang menyenangkan. Meliputi baca tulis Al-Quran, hafalan surat pendek, dan adab islami.',
                'jadwal' => 'Senin - Kamis, 15:30 - 17:00 WIB',
                'persyaratan' => ['Usia 6 - 12 tahun', 'Sudah bisa membaca Iqra jilid 4 ke atas', 'Didampingi orang tua saat pendaftaran'],
                'pengajar' => 'Ust. Mahmud Hasan & Ustzh. Siti Aminah',
                'wa' => '6281234567891',
                'icon' => 'academic-cap',
                'color' => 'emerald',
            ],
            [
                'nama' => 'Kelas Dewasa',
                'deskripsi' => 'Program belajar membaca Al-Quran untuk dewasa dengan pendekatan santai dan penuh pengertian. Fokus pada tajwid dan kelancaran bacaan.',
                'jadwal' => 'Selasa & Kamis, 19:30 - 21:00 WIB (Ba\'da Isya)',
                'persyaratan' => ['Usia 17 tahun ke atas', 'Sudah bisa membaca huruf hijaiyyah dasar', 'Komitmen hadir rutin'],
                'pengajar' => 'Ust. Abdul Karim, S.Ag.',
                'wa' => '6281234567892',
                'icon' => 'users',
                'color' => 'purple',
            ],
            [
                'nama' => 'Kelas Tahfidz',
                'deskripsi' => 'Program menghafal Al-Quran (Tahfidz) dengan metode Talaqqi dan Muroja\'ah. Dimulai dari Juz 30 (Juz Amma) dan surat-surat pilihan.',
                'jadwal' => 'Sabtu & Minggu, 08:00 - 10:00 WIB',
                'persyaratan' => ['Sudah lancar membaca Al-Quran', 'Lulus tes bacaan oleh pengajar', 'Komitmen setoran hafalan mingguan'],
                'pengajar' => 'Ust. Hafidz Muhammad Yusuf',
                'wa' => '6281234567893',
                'icon' => 'star',
                'color' => 'amber',
            ],
        ];

        return view('public.belajar-islam.mengaji', compact('classes'));
    }
}
