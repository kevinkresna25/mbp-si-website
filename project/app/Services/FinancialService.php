<?php

namespace App\Services;

use App\Enums\CategoryZiswaf;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\Transaction;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class FinancialService
{
    private const CACHE_TTL = 1800; // 30 minutes

    /**
     * Get balance for a specific ZISWAF category.
     */
    public function getBalanceByCategory(string $category): array
    {
        return Cache::remember("balance_{$category}", self::CACHE_TTL, function () use ($category) {
            $debit = Transaction::approved()
                ->byZiswaf($category)
                ->debit()
                ->sum('nominal');

            $credit = Transaction::approved()
                ->byZiswaf($category)
                ->credit()
                ->sum('nominal');

            return [
                'category' => $category,
                'label' => CategoryZiswaf::from($category)->label(),
                'debit' => (float) $debit,
                'credit' => (float) $credit,
                'balance' => (float) ($debit - $credit),
            ];
        });
    }

    /**
     * Get balances for all ZISWAF categories.
     */
    public function getAllBalances(): array
    {
        return Cache::remember('all_balances', self::CACHE_TTL, function () {
            $balances = [];
            $totalDebit = 0;
            $totalCredit = 0;

            foreach (CategoryZiswaf::cases() as $category) {
                $balance = $this->getBalanceByCategoryDirect($category->value);
                $balances[] = $balance;
                $totalDebit += $balance['debit'];
                $totalCredit += $balance['credit'];
            }

            return [
                'categories' => $balances,
                'total_debit' => $totalDebit,
                'total_credit' => $totalCredit,
                'total_balance' => $totalDebit - $totalCredit,
            ];
        });
    }

    /**
     * Get monthly financial report.
     */
    public function getMonthlyReport(int $year, int $month): array
    {
        $cacheKey = "monthly_report_{$year}_{$month}";

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($year, $month) {
            $transactions = Transaction::approved()
                ->whereYear('tanggal', $year)
                ->whereMonth('tanggal', $month)
                ->orderBy('tanggal')
                ->get();

            $summary = [];
            foreach (CategoryZiswaf::cases() as $category) {
                $catTransactions = $transactions->where('category_ziswaf', $category);
                $debit = $catTransactions->where('type', TransactionType::Debit)->sum('nominal');
                $credit = $catTransactions->where('type', TransactionType::Credit)->sum('nominal');

                $summary[$category->value] = [
                    'label' => $category->label(),
                    'debit' => (float) $debit,
                    'credit' => (float) $credit,
                    'balance' => (float) ($debit - $credit),
                ];
            }

            return [
                'year' => $year,
                'month' => $month,
                'transactions' => $transactions,
                'summary' => $summary,
                'total_debit' => $transactions->where('type', TransactionType::Debit)->sum('nominal'),
                'total_credit' => $transactions->where('type', TransactionType::Credit)->sum('nominal'),
            ];
        });
    }

    /**
     * Get transaction trends for the last N months.
     */
    public function getTransactionTrends(int $months = 6): array
    {
        $cacheKey = "transaction_trends_{$months}";

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($months) {
            $trends = [];

            for ($i = $months - 1; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $year = $date->year;
                $month = $date->month;

                $debit = Transaction::approved()
                    ->debit()
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $month)
                    ->sum('nominal');

                $credit = Transaction::approved()
                    ->credit()
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $month)
                    ->sum('nominal');

                $trends[] = [
                    'period' => $date->format('M Y'),
                    'year' => $year,
                    'month' => $month,
                    'debit' => (float) $debit,
                    'credit' => (float) $credit,
                    'net' => (float) ($debit - $credit),
                ];
            }

            return $trends;
        });
    }

    /**
     * Validate ZISWAF usage rules.
     */
    public function validateZiswafUsage(string $category, string $purpose): bool
    {
        return CategoryZiswaf::from($category)->canBeUsedFor($purpose);
    }

    /**
     * Clear all financial caches.
     */
    public function clearCache(): void
    {
        Cache::forget('all_balances');

        foreach (CategoryZiswaf::cases() as $category) {
            Cache::forget("balance_{$category->value}");
        }

        // Clear monthly report caches for recent months
        for ($i = 0; $i < 12; $i++) {
            $date = now()->subMonths($i);
            Cache::forget("monthly_report_{$date->year}_{$date->month}");
        }

        Cache::forget('transaction_trends_6');
        Cache::forget('transaction_trends_12');
    }

    /**
     * Direct balance calculation without cache (used internally).
     */
    private function getBalanceByCategoryDirect(string $category): array
    {
        $debit = Transaction::approved()
            ->byZiswaf($category)
            ->debit()
            ->sum('nominal');

        $credit = Transaction::approved()
            ->byZiswaf($category)
            ->credit()
            ->sum('nominal');

        return [
            'category' => $category,
            'label' => CategoryZiswaf::from($category)->label(),
            'debit' => (float) $debit,
            'credit' => (float) $credit,
            'balance' => (float) ($debit - $credit),
        ];
    }
}
