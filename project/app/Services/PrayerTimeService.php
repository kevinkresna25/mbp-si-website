<?php

namespace App\Services;

use App\Models\PrayerTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PrayerTimeService
{
    private const API_URL = 'https://api.aladhan.com/v1/timingsByCity';
    private const CACHE_TTL = 86400; // 24 hours

    /**
     * Get prayer times for today.
     */
    public function getToday(): ?PrayerTime
    {
        $today = Carbon::today();
        $cacheKey = 'prayer_time_' . $today->format('Y-m-d');

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($today) {
            // Try from database first
            $prayerTime = PrayerTime::where('tanggal', $today->format('Y-m-d'))->first();

            if ($prayerTime) {
                return $prayerTime;
            }

            // Try fetching from API
            $prayerTime = $this->fetchFromAPI($today->format('d-m-Y'));

            if ($prayerTime) {
                return $prayerTime;
            }

            // Fallback to nearest cached date
            return $this->getFromFallback();
        });
    }

    /**
     * Get prayer times for a full month.
     */
    public function getMonth(int $month, int $year): array
    {
        $cacheKey = "prayer_times_{$year}_{$month}";

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($month, $year) {
            $start = Carbon::create($year, $month, 1);
            $end = $start->copy()->endOfMonth();

            return PrayerTime::whereBetween('tanggal', [$start, $end])
                ->orderBy('tanggal')
                ->get()
                ->toArray();
        });
    }

    /**
     * Determine the next prayer based on current time.
     */
    public function getNextPrayer(): ?array
    {
        $today = $this->getToday();

        if (!$today) {
            return null;
        }

        $now = Carbon::now();
        $prayers = [
            'Subuh'   => $today->subuh,
            'Dzuhur'  => $today->dzuhur,
            'Ashar'   => $today->ashar,
            'Maghrib' => $today->maghrib,
            'Isya'    => $today->isya,
        ];

        foreach ($prayers as $name => $time) {
            $prayerTime = Carbon::createFromFormat('H:i:s', $time);

            if ($now->lt($prayerTime)) {
                return [
                    'name' => $name,
                    'time' => Carbon::createFromFormat('H:i:s', $time)->format('H:i'),
                    'countdown' => $now->diff($prayerTime)->format('%H:%I:%S'),
                ];
            }
        }

        // All prayers have passed; next is Subuh tomorrow
        return [
            'name' => 'Subuh',
            'time' => Carbon::createFromFormat('H:i:s', $today->subuh)->format('H:i'),
            'countdown' => 'Besok',
        ];
    }

    /**
     * Fetch prayer times from the Aladhan API.
     */
    public function fetchFromAPI(string $date): ?PrayerTime
    {
        try {
            $response = Http::timeout(10)->get(self::API_URL . "/{$date}", [
                'city'    => 'Surabaya',
                'country' => 'Indonesia',
                'method'  => 20, // Kemenag
            ]);

            if (!$response->successful()) {
                Log::warning('Prayer time API returned non-success status', [
                    'status' => $response->status(),
                    'date'   => $date,
                ]);
                return null;
            }

            $data = $response->json('data.timings');

            if (!$data) {
                return null;
            }

            // Parse date from dd-mm-yyyy to Y-m-d
            $tanggal = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');

            return PrayerTime::updateOrCreate(
                ['tanggal' => $tanggal],
                [
                    'subuh'   => $data['Fajr'] ?? '04:30',
                    'dzuhur'  => $data['Dhuhr'] ?? '11:45',
                    'ashar'   => $data['Asr'] ?? '15:00',
                    'maghrib' => $data['Maghrib'] ?? '17:30',
                    'isya'    => $data['Isha'] ?? '18:45',
                    'imsak'   => $data['Imsak'] ?? null,
                ]
            );
        } catch (\Exception $e) {
            Log::error('Failed to fetch prayer times from API', [
                'error' => $e->getMessage(),
                'date'  => $date,
            ]);
            return null;
        }
    }

    /**
     * Get the last available prayer time from the database as fallback.
     */
    public function getFromFallback(): ?PrayerTime
    {
        return PrayerTime::orderBy('tanggal', 'desc')->first();
    }
}
