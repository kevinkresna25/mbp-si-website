<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\DonationTarget;
use App\Services\FinancialService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function __construct(
        private FinancialService $financialService,
    ) {}

    /**
     * Display the public financial dashboard.
     */
    public function index()
    {
        $balances = $this->financialService->getAllBalances();
        $donationTargets = DonationTarget::active()->orderBy('created_at', 'desc')->get();

        return view('public.keuangan.index', compact('balances', 'donationTargets'));
    }

    /**
     * Display the QRIS donation page.
     */
    public function donasi()
    {
        $donationTargets = DonationTarget::active()->orderBy('created_at', 'desc')->get();

        return view('public.keuangan.donasi', compact('donationTargets'));
    }

    /**
     * Generate and download monthly PDF report.
     */
    public function laporanPdf(int $year, int $month)
    {
        if ($month < 1 || $month > 12 || $year < 2020 || $year > now()->year) {
            abort(404, 'Periode laporan tidak valid.');
        }

        $report = $this->financialService->getMonthlyReport($year, $month);
        $balances = $this->financialService->getAllBalances();

        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        $pdf = Pdf::loadView('pdf.laporan-keuangan', [
            'report' => $report,
            'balances' => $balances,
            'monthName' => $months[$month],
            'year' => $year,
            'month' => $month,
        ]);

        $pdf->setPaper('a4', 'portrait');

        $filename = "Laporan-Keuangan-MBP-{$months[$month]}-{$year}.pdf";

        return $pdf->stream($filename);
    }
}
