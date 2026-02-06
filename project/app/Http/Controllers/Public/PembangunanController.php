<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\PembangunanFase;
use App\Services\FinancialService;

class PembangunanController extends Controller
{
    public function __construct(
        private FinancialService $financialService,
    ) {}

    public function index()
    {
        $fases = PembangunanFase::with('media')
            ->orderBy('order_column')
            ->get();

        $overallProgress = PembangunanFase::getOverallProgress();

        // Get wakaf balance for construction fund information
        $wakafBalance = $this->financialService->getBalanceByCategory('wakaf');

        return view('public.pembangunan.index', compact('fases', 'overallProgress', 'wakafBalance'));
    }
}
