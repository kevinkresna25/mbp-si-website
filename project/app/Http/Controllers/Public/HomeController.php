<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\DonationTarget;
use App\Models\Gallery;
use App\Models\KutipanHikmah;
use App\Models\Pengumuman;
use App\Models\StaticPage;
use App\Services\PrayerTimeService;

class HomeController extends Controller
{
    public function __construct(
        private PrayerTimeService $prayerTimeService,
    ) {}

    public function index()
    {
        $prayerTime = $this->prayerTimeService->getToday();
        $nextPrayer = $this->prayerTimeService->getNextPrayer();

        $pengumuman = Pengumuman::active()
            ->latest()
            ->take(3)
            ->get();

        $galleries = Gallery::with('media')
            ->latest()
            ->take(8)
            ->get();

        $donationTargets = DonationTarget::active()->get();

        $kutipanHikmah = KutipanHikmah::active()->inRandomOrder()->first();

        $sambutan = StaticPage::where('key', 'sambutan_ketua')->first();

        return view('public.home', compact(
            'prayerTime',
            'nextPrayer',
            'pengumuman',
            'galleries',
            'donationTargets',
            'kutipanHikmah',
            'sambutan',
        ));
    }
}
