<?php

namespace App\Services;

use App\Models\PrayerTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PrayerTimeService
{
    private const API_BASE = 'https://api.aladhan.com/v1';
    private const CACHE_TTL = 86400; // 24 hours

    /**
     * Get prayer times for today.
     */
    public function getToday(): ?PrayerTime
    {
        $today = Carbon::today();
        $cacheKey = 'prayer_time_' . $today->format('Y-m-d');

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($today) {
            // Try fetching fresh data from API first
            $prayerTime = $this->fetchFromAPI($today->format('d-m-Y'));

            if ($prayerTime) {
                return $prayerTime;
            }

            // Fallback to database if API is unavailable
            $prayerTime = PrayerTime::where('tanggal', $today->format('Y-m-d'))->first();

            if ($prayerTime) {
                return $prayerTime;
            }

            // Last resort: nearest available date from DB
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
            // Try fetching fresh data from API first
            $results = $this->fetchMonthFromAPI($month, $year);

            if (!empty($results)) {
                // Data is now saved in DB by fetchMonthFromAPI, query it back sorted
                $start = Carbon::create($year, $month, 1);
                $end = $start->copy()->endOfMonth();

                return PrayerTime::whereBetween('tanggal', [$start, $end])
                    ->orderBy('tanggal')
                    ->get()
                    ->toArray();
            }

            // Fallback to database if API is unavailable
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
     * Normalize time string from API to H:i:s format.
     * Handles both "04:11" and "04:11 (WIB)" formats.
     */
    private function normalizeTime(?string $time, string $default): string
    {
        if (!$time) {
            return $default;
        }

        // Strip timezone suffix like " (WIB)", " (WITA)", etc.
        $cleaned = preg_replace('/\s*\([^)]*\)$/', '', trim($time));

        return Carbon::createFromFormat('H:i', $cleaned)->format('H:i:s');
    }

    /**
     * Map API timings array to database columns.
     */
    private function mapTimings(array $data): array
    {
        return [
            'subuh'   => $this->normalizeTime($data['Fajr'] ?? null, '04:30:00'),
            'terbit'  => isset($data['Sunrise']) ? $this->normalizeTime($data['Sunrise'], '05:30:00') : null,
            'dzuhur'  => $this->normalizeTime($data['Dhuhr'] ?? null, '11:45:00'),
            'ashar'   => $this->normalizeTime($data['Asr'] ?? null, '15:00:00'),
            'maghrib' => $this->normalizeTime($data['Maghrib'] ?? null, '17:30:00'),
            'isya'    => $this->normalizeTime($data['Isha'] ?? null, '18:45:00'),
            'imsak'   => isset($data['Imsak']) ? $this->normalizeTime($data['Imsak'], '04:20:00') : null,
        ];
    }

    /**
     * Fetch prayer times for a single day from the Aladhan API.
     */
    public function fetchFromAPI(string $date): ?PrayerTime
    {
        try {
            $response = Http::timeout(10)->get(self::API_BASE . "/timingsByCity/{$date}", [
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

            $tanggal = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');

            return PrayerTime::updateOrCreate(
                ['tanggal' => $tanggal],
                $this->mapTimings($data)
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
     * Fetch prayer times for a full month from the Aladhan API.
     */
    public function fetchMonthFromAPI(int $month, int $year): array
    {
        try {
            $response = Http::timeout(15)->get(self::API_BASE . "/calendarByCity/{$year}/{$month}", [
                'city'    => 'Surabaya',
                'country' => 'Indonesia',
                'method'  => 20, // Kemenag
            ]);

            if (!$response->successful()) {
                Log::warning('Prayer calendar API returned non-success status', [
                    'status' => $response->status(),
                    'month'  => $month,
                    'year'   => $year,
                ]);
                return [];
            }

            $days = $response->json('data');

            if (!$days || !is_array($days)) {
                return [];
            }

            $results = [];

            foreach ($days as $day) {
                $timings = $day['timings'] ?? null;
                $dateStr = $day['date']['gregorian']['date'] ?? null;

                if (!$timings || !$dateStr) {
                    continue;
                }

                $tanggal = Carbon::createFromFormat('d-m-Y', $dateStr)->format('Y-m-d');

                $results[] = PrayerTime::updateOrCreate(
                    ['tanggal' => $tanggal],
                    $this->mapTimings($timings)
                );
            }

            // Auto-cleanup: hapus data lebih lama dari 2 bulan
            if (!empty($results)) {
                PrayerTime::where('tanggal', '<', Carbon::now()->subMonths(2)->startOfMonth())
                    ->delete();
            }

            return $results;
        } catch (\Exception $e) {
            Log::error('Failed to fetch monthly prayer times from API', [
                'error' => $e->getMessage(),
                'month' => $month,
                'year'  => $year,
            ]);
            return [];
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
