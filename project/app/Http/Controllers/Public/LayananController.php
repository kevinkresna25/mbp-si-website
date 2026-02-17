<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\PrayerTime;
use App\Models\StaticPage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Jadwal Salat - Full month prayer times table.
     */
    public function jadwalSalat(Request $request)
    {
        $year = $request->input('year', now()->year);
        $month = $request->input('month', now()->month);

        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        $prayerTimes = PrayerTime::whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal')
            ->get()
            ->keyBy(fn($item) => $item->tanggal->format('Y-m-d'));

        $currentDate = Carbon::createFromDate($year, $month, 1);
        $prevMonth = $currentDate->copy()->subMonth();
        $nextMonth = $currentDate->copy()->addMonth();

        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        return view('public.layanan.jadwal-salat', compact(
            'prayerTimes', 'year', 'month', 'months',
            'startDate', 'endDate', 'prevMonth', 'nextMonth'
        ));
    }

    /**
     * Nikah - Marriage service information with WA redirect.
     */
    public function nikah()
    {
        $page = StaticPage::where('key', 'layanan_nikah')->firstOrFail();

        return view('public.layanan.nikah', compact('page'));
    }

    /**
     * Konsultasi - Ustadz consultation contacts.
     */
    public function konsultasi()
    {
        $ustadzList = [
            [
                'nama' => 'Ust. Ahmad Fauzi, Lc.',
                'bidang' => 'Fiqih & Muamalah',
                'wa' => '6281234567890',
                'jadwal' => 'Senin - Kamis, 09:00 - 12:00',
            ],
            [
                'nama' => 'Ust. Muhammad Ridwan, S.Ag.',
                'bidang' => 'Aqidah & Tauhid',
                'wa' => '6281234567891',
                'jadwal' => 'Selasa & Kamis, 13:00 - 16:00',
            ],
            [
                'nama' => 'Ust. Abdul Hakim, M.A.',
                'bidang' => 'Konseling Keluarga',
                'wa' => '6281234567892',
                'jadwal' => 'Rabu & Jumat, 09:00 - 12:00',
            ],
        ];

        return view('public.layanan.konsultasi', compact('ustadzList'));
    }

    /**
     * Permohonan - Facility request information with WA redirect.
     */
    public function permohonan()
    {
        $page = StaticPage::where('key', 'layanan_permohonan')->firstOrFail();

        return view('public.layanan.permohonan', compact('page'));
    }
}
