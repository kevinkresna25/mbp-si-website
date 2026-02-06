<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Transaction;
use App\Services\FinancialService;
use App\Enums\TransactionType;
use App\Enums\CategoryZiswaf;
use App\Enums\TransactionStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FinancialServiceTest extends TestCase
{
    use RefreshDatabase;

    private FinancialService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new FinancialService();
    }

    public function test_balance_calculation_for_ziswaf_category(): void
    {
        $user = User::factory()->create();

        Transaction::create([
            'transaction_code' => 'TRX-TEST-001',
            'tanggal' => now(),
            'type' => 'debit',
            'category_ziswaf' => 'zakat',
            'category_detail' => 'Zakat Fitrah',
            'nominal' => 1000000,
            'status' => 'approved',
            'created_by' => $user->id,
            'approved_by' => $user->id,
            'approved_at' => now(),
        ]);

        Transaction::create([
            'transaction_code' => 'TRX-TEST-002',
            'tanggal' => now(),
            'type' => 'credit',
            'category_ziswaf' => 'zakat',
            'category_detail' => 'Distribusi Zakat',
            'nominal' => 300000,
            'status' => 'approved',
            'created_by' => $user->id,
            'approved_by' => $user->id,
            'approved_at' => now(),
        ]);

        // getBalanceByCategory returns an array with 'balance' key
        $result = $this->service->getBalanceByCategory(CategoryZiswaf::Zakat->value);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('balance', $result);
        $this->assertEquals(700000, $result['balance']);
        $this->assertEquals(1000000, $result['debit']);
        $this->assertEquals(300000, $result['credit']);
    }

    public function test_draft_transactions_not_included_in_balance(): void
    {
        $user = User::factory()->create();

        Transaction::create([
            'transaction_code' => 'TRX-TEST-003',
            'tanggal' => now(),
            'type' => 'debit',
            'category_ziswaf' => 'infaq',
            'category_detail' => 'Infaq Jumat',
            'nominal' => 500000,
            'status' => 'draft',
            'created_by' => $user->id,
        ]);

        $result = $this->service->getBalanceByCategory(CategoryZiswaf::Infaq->value);
        $this->assertEquals(0, $result['balance']);
    }

    public function test_get_all_balances_returns_array(): void
    {
        $user = User::factory()->create();

        Transaction::create([
            'transaction_code' => 'TRX-TEST-004',
            'tanggal' => now(),
            'type' => 'debit',
            'category_ziswaf' => 'operasional',
            'category_detail' => 'Donasi Umum',
            'nominal' => 250000,
            'status' => 'approved',
            'created_by' => $user->id,
            'approved_by' => $user->id,
            'approved_at' => now(),
        ]);

        $balances = $this->service->getAllBalances();
        $this->assertIsArray($balances);
        $this->assertArrayHasKey('categories', $balances);
        $this->assertArrayHasKey('total_debit', $balances);
        $this->assertArrayHasKey('total_credit', $balances);
        $this->assertArrayHasKey('total_balance', $balances);
        $this->assertCount(count(CategoryZiswaf::cases()), $balances['categories']);
    }

    public function test_transaction_code_auto_generation(): void
    {
        $code = Transaction::generateTransactionCode();
        $this->assertStringStartsWith('TRX-', $code);
        $this->assertMatchesRegularExpression('/^TRX-\d{8}-\d{3}$/', $code);
    }

    public function test_monthly_report_structure(): void
    {
        $report = $this->service->getMonthlyReport(now()->year, now()->month);
        $this->assertArrayHasKey('year', $report);
        $this->assertArrayHasKey('month', $report);
        $this->assertArrayHasKey('transactions', $report);
        $this->assertArrayHasKey('summary', $report);
        $this->assertArrayHasKey('total_debit', $report);
        $this->assertArrayHasKey('total_credit', $report);
    }

    public function test_monthly_report_includes_only_approved_transactions(): void
    {
        $user = User::factory()->create();
        $year = now()->year;
        $month = now()->month;

        // Approved transaction
        Transaction::create([
            'transaction_code' => 'TRX-TEST-005',
            'tanggal' => now(),
            'type' => 'debit',
            'category_ziswaf' => 'infaq',
            'category_detail' => 'Infaq Jumat',
            'nominal' => 100000,
            'status' => 'approved',
            'created_by' => $user->id,
            'approved_by' => $user->id,
            'approved_at' => now(),
        ]);

        // Draft transaction (should be excluded)
        Transaction::create([
            'transaction_code' => 'TRX-TEST-006',
            'tanggal' => now(),
            'type' => 'debit',
            'category_ziswaf' => 'infaq',
            'category_detail' => 'Infaq Lain',
            'nominal' => 200000,
            'status' => 'draft',
            'created_by' => $user->id,
        ]);

        $report = $this->service->getMonthlyReport($year, $month);
        $this->assertEquals(100000, $report['total_debit']);
    }

    public function test_transaction_code_increments_daily(): void
    {
        $user = User::factory()->create();

        Transaction::create([
            'transaction_code' => 'TRX-' . now()->format('Ymd') . '-001',
            'tanggal' => now(),
            'type' => 'debit',
            'category_ziswaf' => 'infaq',
            'category_detail' => 'Test',
            'nominal' => 10000,
            'status' => 'draft',
            'created_by' => $user->id,
        ]);

        $nextCode = Transaction::generateTransactionCode();
        $this->assertStringEndsWith('-002', $nextCode);
    }

    public function test_transaction_trends_returns_correct_months(): void
    {
        $trends = $this->service->getTransactionTrends(3);
        $this->assertCount(3, $trends);

        foreach ($trends as $trend) {
            $this->assertArrayHasKey('period', $trend);
            $this->assertArrayHasKey('debit', $trend);
            $this->assertArrayHasKey('credit', $trend);
            $this->assertArrayHasKey('net', $trend);
        }
    }

    public function test_ziswaf_usage_validation(): void
    {
        // Zakat can be used for mustahiq
        $this->assertTrue($this->service->validateZiswafUsage('zakat', 'mustahiq'));
        // Zakat cannot be used for operational
        $this->assertFalse($this->service->validateZiswafUsage('zakat', 'operational'));
        // Infaq can be used for operational
        $this->assertTrue($this->service->validateZiswafUsage('infaq', 'operational'));
        // Wakaf can be used for construction
        $this->assertTrue($this->service->validateZiswafUsage('wakaf', 'construction'));
    }

    public function test_clear_cache_does_not_throw(): void
    {
        // Simply ensure clearing cache runs without exception
        $this->service->clearCache();
        $this->assertTrue(true);
    }
}
