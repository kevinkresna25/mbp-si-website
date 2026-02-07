<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrayerTime;
use App\Services\PrayerTimeService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class PrayerTimeController extends Controller
{
    public function index()
    {
        $month = now()->month;
        $year = now()->year;

        $prayerTimes = PrayerTime::whereBetween('tanggal', [
            Carbon::create($year, $month, 1)->startOfDay(),
            Carbon::create($year, $month, 1)->endOfMonth()->endOfDay(),
        ])->orderBy('tanggal')->get();

        $lastUpdated = $prayerTimes->max('updated_at');

        return view('admin.prayer-times.index', compact('prayerTimes', 'month', 'year', 'lastUpdated'));
    }

    public function sync(PrayerTimeService $service)
    {
        $month = now()->month;
        $year = now()->year;

        $results = $service->fetchMonthFromAPI($month, $year);

        // Clear related caches
        Cache::forget("prayer_times_{$year}_{$month}");
        Cache::forget('prayer_time_' . now()->format('Y-m-d'));

        if (!empty($results)) {
            return redirect()->route('admin.prayer-times.index')
                ->with('success', 'Jadwal sholat bulan ini berhasil disinkronisasi (' . count($results) . ' hari).');
        }

        return redirect()->route('admin.prayer-times.index')
            ->with('error', 'Gagal menyinkronisasi jadwal sholat. Pastikan koneksi internet tersedia.');
    }
}
