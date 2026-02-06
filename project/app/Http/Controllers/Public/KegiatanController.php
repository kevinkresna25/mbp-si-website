<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $kegiatan = Kegiatan::query()
            ->when($request->jenis, fn($q, $j) => $q->where('jenis', $j))
            ->when($request->bulan, function ($q, $bulan) {
                $date = Carbon::createFromFormat('Y-m', $bulan);
                $q->whereYear('tanggal', $date->year)
                  ->whereMonth('tanggal', $date->month);
            })
            ->orderBy('tanggal', 'desc')
            ->paginate(12)
            ->withQueryString();

        $jenisOptions = [
            'kajian' => 'Kajian Rutin',
            'maulid' => 'Hari Besar Islam',
            'sosial' => 'Program Sosial',
            'remaja' => 'Kegiatan Remaja',
        ];

        return view('public.kegiatan.index', compact('kegiatan', 'jenisOptions'));
    }

    public function show(int $id)
    {
        $kegiatan = Kegiatan::with('creator')->findOrFail($id);

        $relatedKegiatan = Kegiatan::where('jenis', $kegiatan->jenis)
            ->where('id', '!=', $kegiatan->id)
            ->orderBy('tanggal', 'desc')
            ->take(3)
            ->get();

        return view('public.kegiatan.show', compact('kegiatan', 'relatedKegiatan'));
    }

    public function kalender(Request $request)
    {
        $year = $request->input('year', now()->year);
        $month = $request->input('month', now()->month);

        $kegiatan = Kegiatan::whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->orderBy('tanggal')
            ->get();

        $currentDate = Carbon::createFromDate($year, $month, 1);
        $daysInMonth = $currentDate->daysInMonth;
        $startDayOfWeek = $currentDate->dayOfWeek; // 0 = Sunday

        $prevMonth = $currentDate->copy()->subMonth();
        $nextMonth = $currentDate->copy()->addMonth();

        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        return view('public.kegiatan.kalender', compact(
            'kegiatan', 'year', 'month', 'daysInMonth', 'startDayOfWeek',
            'prevMonth', 'nextMonth', 'months', 'currentDate'
        ));
    }
}
