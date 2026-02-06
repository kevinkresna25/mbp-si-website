<?php

namespace Database\Seeders;

use App\Models\KutipanHikmah;
use App\Models\Pengumuman;
use App\Models\PrayerTime;
use App\Models\StaticPage;
use App\Models\Struktur;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedStaticPages();
        $this->seedStruktur();
        $this->seedPengumuman();
        $this->seedKutipanHikmah();
        $this->seedPrayerTimes();
    }

    private function seedStaticPages(): void
    {
        $pages = [
            [
                'key'   => 'sambutan_ketua',
                'title' => 'Sambutan Ketua Takmir',
                'content' => '<p>Assalamu\'alaikum Warahmatullahi Wabarakatuh.</p>
<p>Segala puji bagi Allah SWT yang telah melimpahkan rahmat dan karunia-Nya, sehingga kita dapat terus beribadah dan beramal shaleh di Masjid Bukit Palma.</p>
<p>Masjid Bukit Palma hadir sebagai pusat ibadah, pendidikan, dan kegiatan sosial bagi warga Perumahan Bukit Palma dan sekitarnya. Kami berkomitmen untuk menjadikan masjid ini sebagai tempat yang nyaman, transparan, dan bermanfaat bagi seluruh jamaah.</p>
<p>Melalui website ini, kami ingin membangun kepercayaan jamaah melalui transparansi digital, mulai dari laporan keuangan yang terbuka, informasi kegiatan yang terupdate, hingga layanan donasi yang mudah diakses.</p>
<p>Semoga Allah SWT meridhai setiap langkah kita dalam memakmurkan rumah-Nya.</p>
<p>Wassalamu\'alaikum Warahmatullahi Wabarakatuh.</p>',
            ],
            [
                'key'   => 'sejarah',
                'title' => 'Sejarah Masjid Bukit Palma',
                'content' => '<p>Masjid Bukit Palma didirikan pada tahun 2005, seiring dengan berkembangnya Perumahan Bukit Palma di kawasan Surabaya Barat. Awalnya, musholla kecil menjadi tempat berkumpul warga untuk menunaikan sholat berjamaah.</p>
<p>Seiring bertambahnya jumlah jamaah, pada tahun 2010 dilakukan pembangunan masjid pertama dengan kapasitas 200 jamaah. Pembangunan ini dimungkinkan berkat gotong royong warga dan donasi dari berbagai pihak.</p>
<p>Pada tahun 2018, masjid direnovasi dan diperluas untuk mengakomodasi kebutuhan jamaah yang terus bertambah. Fasilitas pendukung seperti ruang belajar, perpustakaan mini, dan taman bermain anak turut dibangun.</p>
<p>Saat ini, Masjid Bukit Palma berdiri megah sebagai pusat kegiatan keagamaan dan sosial warga Perumahan Bukit Palma, dengan berbagai program rutin seperti kajian mingguan, TPA, dan kegiatan sosial lainnya.</p>',
            ],
            [
                'key'   => 'visi_misi',
                'title' => 'Visi & Misi Masjid Bukit Palma',
                'content' => '<h3>Visi</h3>
<p>Menjadikan Masjid Bukit Palma sebagai pusat ibadah, pendidikan, dan pemberdayaan umat yang modern, transparan, dan bermanfaat bagi masyarakat.</p>

<h3>Misi</h3>
<ol>
<li>Menyelenggarakan kegiatan ibadah yang khusyuk dan teratur sesuai sunnah Rasulullah SAW.</li>
<li>Mengembangkan program pendidikan Islam untuk semua kalangan usia.</li>
<li>Membangun transparansi pengelolaan keuangan masjid melalui teknologi digital.</li>
<li>Menjalin ukhuwah Islamiyah antar warga melalui kegiatan sosial dan kemasyarakatan.</li>
<li>Menyediakan fasilitas masjid yang nyaman, bersih, dan modern.</li>
<li>Mengoptimalkan peran pemuda dalam kemakmuran masjid.</li>
</ol>',
            ],
            [
                'key'   => 'lokasi',
                'title' => 'Lokasi Masjid Bukit Palma',
                'content' => '<p>Masjid Bukit Palma berlokasi di jantung Perumahan Bukit Palma, Surabaya Barat, Jawa Timur.</p>
<p><strong>Alamat lengkap:</strong><br>Perumahan Bukit Palma, Surabaya, Jawa Timur, Indonesia</p>
<p><strong>Akses:</strong> Masjid mudah dijangkau dari jalan utama perumahan. Tersedia area parkir yang luas untuk mobil dan motor.</p>
<p><strong>Kontak:</strong><br>
Telepon: -<br>
Email: info@masjidbukitpalma.or.id</p>',
            ],
        ];

        foreach ($pages as $page) {
            StaticPage::firstOrCreate(
                ['key' => $page['key']],
                $page
            );
        }
    }

    private function seedStruktur(): void
    {
        $struktur = [
            ['nama' => 'H. Ahmad Fauzi', 'jabatan' => 'Ketua Takmir', 'order_column' => 1, 'kontak' => null],
            ['nama' => 'Ir. Bambang Setiawan', 'jabatan' => 'Wakil Ketua', 'order_column' => 2, 'kontak' => null],
            ['nama' => 'Drs. Cahyo Nugroho', 'jabatan' => 'Sekretaris', 'order_column' => 3, 'kontak' => null],
            ['nama' => 'H. Dedi Supriadi', 'jabatan' => 'Bendahara', 'order_column' => 4, 'kontak' => null],
            ['nama' => 'Ust. Eko Prasetyo', 'jabatan' => 'Sie. Dakwah & Pendidikan', 'order_column' => 5, 'kontak' => null],
        ];

        foreach ($struktur as $item) {
            Struktur::firstOrCreate(
                ['nama' => $item['nama']],
                $item
            );
        }
    }

    private function seedPengumuman(): void
    {
        $admin = User::where('email', 'admin@masjidbukitpalma.or.id')->first();
        $createdBy = $admin?->id ?? 1;

        $pengumuman = [
            [
                'title'      => 'Jadwal Kajian Rutin Pekan Ini',
                'content'    => 'Kajian rutin ba\'da Maghrib setiap hari Rabu dan Jumat. Tema minggu ini: "Adab Bertetangga dalam Islam". Pemateri: Ust. Ahmad Fadlullah. Diharapkan kehadiran seluruh jamaah.',
                'status'     => 'active',
                'expired_at' => now()->addDays(7),
                'created_by' => $createdBy,
            ],
            [
                'title'      => 'Pembersihan Masjid Bersama',
                'content'    => 'Dalam rangka menyambut bulan Ramadhan, kami mengajak seluruh warga untuk bergotong-royong membersihkan masjid pada hari Sabtu, pukul 07:00 WIB. Peralatan disediakan panitia. Mari ramaikan!',
                'status'     => 'active',
                'expired_at' => now()->addDays(14),
                'created_by' => $createdBy,
            ],
            [
                'title'      => 'Pendaftaran TPA Semester Baru',
                'content'    => 'Pendaftaran santri TPA Masjid Bukit Palma untuk semester baru telah dibuka. Usia 5-12 tahun. Jadwal: Senin-Kamis, pukul 15:30-17:00 WIB. Pendaftaran di sekretariat masjid atau hubungi pengurus.',
                'status'     => 'active',
                'expired_at' => now()->addMonth(),
                'created_by' => $createdBy,
            ],
        ];

        foreach ($pengumuman as $item) {
            Pengumuman::firstOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }

    private function seedKutipanHikmah(): void
    {
        $kutipan = [
            ['kutipan_text' => 'Sebaik-baik manusia adalah yang paling bermanfaat bagi manusia lainnya.', 'sumber' => 'HR. Ahmad, Thabrani, Daruqutni', 'is_active' => true],
            ['kutipan_text' => 'Barangsiapa yang menempuh jalan untuk mencari ilmu, maka Allah mudahkan baginya jalan menuju surga.', 'sumber' => 'HR. Muslim', 'is_active' => true],
            ['kutipan_text' => 'Sesungguhnya Allah tidak melihat kepada rupa dan hartamu, tetapi Allah melihat kepada hati dan amalmu.', 'sumber' => 'HR. Muslim', 'is_active' => true],
            ['kutipan_text' => 'Senyummu di hadapan saudaramu adalah sedekah.', 'sumber' => 'HR. Tirmidzi', 'is_active' => true],
            ['kutipan_text' => 'Orang mukmin yang paling sempurna imannya adalah yang paling baik akhlaknya.', 'sumber' => 'HR. Abu Dawud dan Tirmidzi', 'is_active' => true],
        ];

        foreach ($kutipan as $item) {
            KutipanHikmah::firstOrCreate(
                ['kutipan_text' => $item['kutipan_text']],
                $item
            );
        }
    }

    private function seedPrayerTimes(): void
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        // Generate mock prayer times for the current month
        $baseTimings = [
            'subuh'   => '04:28',
            'dzuhur'  => '11:38',
            'ashar'   => '14:58',
            'maghrib' => '17:42',
            'isya'    => '18:55',
            'imsak'   => '04:18',
        ];

        $date = $startOfMonth->copy();
        while ($date->lte($endOfMonth)) {
            // Add slight daily variation (1-2 minutes)
            $dayOfMonth = $date->day;
            $minuteOffset = intval(sin($dayOfMonth * 0.2) * 2);

            PrayerTime::firstOrCreate(
                ['tanggal' => $date->format('Y-m-d')],
                [
                    'subuh'   => Carbon::createFromFormat('H:i', $baseTimings['subuh'])->addMinutes($minuteOffset)->format('H:i:s'),
                    'dzuhur'  => Carbon::createFromFormat('H:i', $baseTimings['dzuhur'])->addMinutes($minuteOffset)->format('H:i:s'),
                    'ashar'   => Carbon::createFromFormat('H:i', $baseTimings['ashar'])->addMinutes($minuteOffset)->format('H:i:s'),
                    'maghrib' => Carbon::createFromFormat('H:i', $baseTimings['maghrib'])->addMinutes($minuteOffset)->format('H:i:s'),
                    'isya'    => Carbon::createFromFormat('H:i', $baseTimings['isya'])->addMinutes($minuteOffset)->format('H:i:s'),
                    'imsak'   => Carbon::createFromFormat('H:i', $baseTimings['imsak'])->addMinutes($minuteOffset)->format('H:i:s'),
                ]
            );

            $date->addDay();
        }
    }
}
