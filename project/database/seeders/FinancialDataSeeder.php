<?php

namespace Database\Seeders;

use App\Models\DonationTarget;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class FinancialDataSeeder extends Seeder
{
    /**
     * Seed 3 months of realistic financial data for Masjid Bukit Palma.
     */
    public function run(): void
    {
        $this->seedTransactions();
        $this->seedDonationTargets();
    }

    private function seedTransactions(): void
    {
        // Get bendahara and admin users for attribution
        $bendahara = User::where('email', 'bendahara@masjidbukitpalma.or.id')->first();
        $admin = User::where('email', 'admin@masjidbukitpalma.or.id')->first();
        $takmir = User::where('email', 'takmir@masjidbukitpalma.or.id')->first();

        $createdBy = $bendahara?->id ?? 1;
        $approvedBy = $takmir?->id ?? $admin?->id ?? 1;

        // Realistic income templates
        $incomeTemplates = [
            // Zakat
            ['category_ziswaf' => 'zakat', 'category_detail' => 'Zakat Fitrah', 'min' => 50000, 'max' => 500000],
            ['category_ziswaf' => 'zakat', 'category_detail' => 'Zakat Maal', 'min' => 500000, 'max' => 5000000],
            ['category_ziswaf' => 'zakat', 'category_detail' => 'Zakat Profesi', 'min' => 200000, 'max' => 2000000],
            // Infaq
            ['category_ziswaf' => 'infaq', 'category_detail' => 'Infaq Jumat', 'min' => 1500000, 'max' => 4000000],
            ['category_ziswaf' => 'infaq', 'category_detail' => 'Infaq Harian Kotak Amal', 'min' => 200000, 'max' => 800000],
            ['category_ziswaf' => 'infaq', 'category_detail' => 'Infaq Transfer', 'min' => 100000, 'max' => 2000000],
            ['category_ziswaf' => 'infaq', 'category_detail' => 'Infaq Kegiatan Ramadhan', 'min' => 500000, 'max' => 3000000],
            // Sedekah
            ['category_ziswaf' => 'sedekah', 'category_detail' => 'Sedekah Jamaah', 'min' => 50000, 'max' => 1000000],
            ['category_ziswaf' => 'sedekah', 'category_detail' => 'Sedekah Aqiqah', 'min' => 1000000, 'max' => 3000000],
            ['category_ziswaf' => 'sedekah', 'category_detail' => 'Sedekah Sembako', 'min' => 200000, 'max' => 500000],
            // Wakaf
            ['category_ziswaf' => 'wakaf', 'category_detail' => 'Wakaf Pembangunan Masjid', 'min' => 1000000, 'max' => 10000000],
            ['category_ziswaf' => 'wakaf', 'category_detail' => 'Wakaf Al-Quran', 'min' => 100000, 'max' => 500000],
            ['category_ziswaf' => 'wakaf', 'category_detail' => 'Wakaf Perlengkapan Masjid', 'min' => 200000, 'max' => 2000000],
            // Operasional
            ['category_ziswaf' => 'operasional', 'category_detail' => 'Donasi Operasional Umum', 'min' => 100000, 'max' => 1000000],
            ['category_ziswaf' => 'operasional', 'category_detail' => 'Sponsor Kegiatan', 'min' => 500000, 'max' => 5000000],
        ];

        // Realistic expense templates
        $expenseTemplates = [
            // Zakat distribution
            ['category_ziswaf' => 'zakat', 'category_detail' => 'Distribusi Zakat Fakir Miskin', 'min' => 500000, 'max' => 3000000],
            ['category_ziswaf' => 'zakat', 'category_detail' => 'Distribusi Zakat Muallaf', 'min' => 200000, 'max' => 1000000],
            ['category_ziswaf' => 'zakat', 'category_detail' => 'Distribusi Zakat Fisabilillah', 'min' => 300000, 'max' => 1500000],
            // Infaq usage
            ['category_ziswaf' => 'infaq', 'category_detail' => 'Kegiatan Kajian Rutin', 'min' => 200000, 'max' => 500000],
            ['category_ziswaf' => 'infaq', 'category_detail' => 'Perayaan Hari Besar Islam', 'min' => 500000, 'max' => 3000000],
            ['category_ziswaf' => 'infaq', 'category_detail' => 'Santunan Anak Yatim', 'min' => 1000000, 'max' => 3000000],
            // Sedekah usage
            ['category_ziswaf' => 'sedekah', 'category_detail' => 'Bantuan Warga Sakit', 'min' => 300000, 'max' => 1500000],
            ['category_ziswaf' => 'sedekah', 'category_detail' => 'Bantuan Musibah', 'min' => 500000, 'max' => 2000000],
            // Wakaf usage
            ['category_ziswaf' => 'wakaf', 'category_detail' => 'Pembelian Material Bangunan', 'min' => 2000000, 'max' => 15000000],
            ['category_ziswaf' => 'wakaf', 'category_detail' => 'Pembelian Perlengkapan Sholat', 'min' => 500000, 'max' => 2000000],
            // Operasional
            ['category_ziswaf' => 'operasional', 'category_detail' => 'Listrik Masjid', 'min' => 400000, 'max' => 800000],
            ['category_ziswaf' => 'operasional', 'category_detail' => 'Air PDAM', 'min' => 100000, 'max' => 300000],
            ['category_ziswaf' => 'operasional', 'category_detail' => 'Honor Imam & Muadzin', 'min' => 1500000, 'max' => 3000000],
            ['category_ziswaf' => 'operasional', 'category_detail' => 'Honor Penjaga Masjid', 'min' => 1000000, 'max' => 2000000],
            ['category_ziswaf' => 'operasional', 'category_detail' => 'Kebersihan & Perawatan', 'min' => 200000, 'max' => 500000],
            ['category_ziswaf' => 'operasional', 'category_detail' => 'Internet & WiFi', 'min' => 200000, 'max' => 400000],
            ['category_ziswaf' => 'operasional', 'category_detail' => 'ATK & Perlengkapan Kantor', 'min' => 50000, 'max' => 300000],
        ];

        $sequence = 1;

        // Generate 3 months of data
        for ($monthOffset = 2; $monthOffset >= 0; $monthOffset--) {
            $baseDate = Carbon::now()->subMonths($monthOffset)->startOfMonth();
            $daysInMonth = $baseDate->daysInMonth;

            // Generate 50-80 transactions per month
            $transactionCount = rand(50, 80);
            $incomeCount = intval($transactionCount * 0.55); // ~55% income
            $expenseCount = $transactionCount - $incomeCount;

            // Income transactions
            for ($i = 0; $i < $incomeCount; $i++) {
                $template = $incomeTemplates[array_rand($incomeTemplates)];
                $day = rand(1, $daysInMonth);
                $date = $baseDate->copy()->addDays($day - 1);

                // Make it realistic: Infaq Jumat only on Fridays
                if ($template['category_detail'] === 'Infaq Jumat') {
                    // Find the nearest Friday
                    $date = $date->copy()->next(Carbon::FRIDAY);
                    if ($date->month !== $baseDate->month) {
                        $date = $baseDate->copy()->addDays(rand(0, $daysInMonth - 1));
                    }
                }

                // Determine status - 85% approved, 10% submitted, 5% draft
                $statusRoll = rand(1, 100);
                if ($statusRoll <= 85) {
                    $status = 'approved';
                    $approvedAt = $date->copy()->addHours(rand(1, 48));
                    $approvedByUser = $approvedBy;
                } elseif ($statusRoll <= 95) {
                    $status = 'submitted';
                    $approvedAt = null;
                    $approvedByUser = null;
                } else {
                    $status = 'draft';
                    $approvedAt = null;
                    $approvedByUser = null;
                }

                $nominal = $this->generateRealisticAmount($template['min'], $template['max']);

                Transaction::create([
                    'transaction_code' => 'TRX-' . $date->format('Ymd') . '-' . str_pad($sequence++, 3, '0', STR_PAD_LEFT),
                    'tanggal' => $date->format('Y-m-d'),
                    'type' => 'debit',
                    'category_ziswaf' => $template['category_ziswaf'],
                    'category_detail' => $template['category_detail'],
                    'nominal' => $nominal,
                    'keterangan' => $this->generateKeterangan($template['category_detail'], $nominal),
                    'status' => $status,
                    'created_by' => $createdBy,
                    'approved_by' => $approvedByUser,
                    'approved_at' => $approvedAt,
                ]);
            }

            // Expense transactions
            for ($i = 0; $i < $expenseCount; $i++) {
                $template = $expenseTemplates[array_rand($expenseTemplates)];
                $day = rand(1, $daysInMonth);
                $date = $baseDate->copy()->addDays($day - 1);

                // Most expenses are approved (they've already been spent)
                $statusRoll = rand(1, 100);
                if ($statusRoll <= 90) {
                    $status = 'approved';
                    $approvedAt = $date->copy()->addHours(rand(1, 24));
                    $approvedByUser = $approvedBy;
                } elseif ($statusRoll <= 97) {
                    $status = 'submitted';
                    $approvedAt = null;
                    $approvedByUser = null;
                } else {
                    $status = 'draft';
                    $approvedAt = null;
                    $approvedByUser = null;
                }

                $nominal = $this->generateRealisticAmount($template['min'], $template['max']);

                Transaction::create([
                    'transaction_code' => 'TRX-' . $date->format('Ymd') . '-' . str_pad($sequence++, 3, '0', STR_PAD_LEFT),
                    'tanggal' => $date->format('Y-m-d'),
                    'type' => 'credit',
                    'category_ziswaf' => $template['category_ziswaf'],
                    'category_detail' => $template['category_detail'],
                    'nominal' => $nominal,
                    'keterangan' => $this->generateKeterangan($template['category_detail'], $nominal),
                    'status' => $status,
                    'created_by' => $createdBy,
                    'approved_by' => $approvedByUser,
                    'approved_at' => $approvedAt,
                ]);
            }
        }

        $this->command->info('Seeded ' . ($sequence - 1) . ' financial transactions across 3 months.');
    }

    private function seedDonationTargets(): void
    {
        $targets = [
            [
                'name' => 'Pembangunan Menara Masjid',
                'category_ziswaf' => 'wakaf',
                'target_amount' => 150000000,
                'current_amount' => 67500000,
                'start_date' => Carbon::now()->subMonths(3)->format('Y-m-d'),
                'end_date' => Carbon::now()->addMonths(9)->format('Y-m-d'),
                'status' => 'active',
                'description' => 'Pembangunan menara masjid setinggi 25 meter sebagai landmark kawasan Bukit Palma. Dana digunakan untuk material, tukang, dan finishing.',
            ],
            [
                'name' => 'Renovasi Tempat Wudhu',
                'category_ziswaf' => 'infaq',
                'target_amount' => 35000000,
                'current_amount' => 28000000,
                'start_date' => Carbon::now()->subMonths(2)->format('Y-m-d'),
                'end_date' => Carbon::now()->addMonths(1)->format('Y-m-d'),
                'status' => 'active',
                'description' => 'Renovasi total area wudhu pria dan wanita. Penggantian keran, keramik, dan perbaikan saluran air.',
            ],
            [
                'name' => 'Pengadaan Al-Quran & Buku Iqra',
                'category_ziswaf' => 'wakaf',
                'target_amount' => 10000000,
                'current_amount' => 10000000,
                'start_date' => Carbon::now()->subMonths(4)->format('Y-m-d'),
                'end_date' => Carbon::now()->subMonths(1)->format('Y-m-d'),
                'status' => 'completed',
                'description' => 'Pengadaan 100 mushaf Al-Quran dan 50 buku Iqra untuk kegiatan TPA dan jamaah masjid.',
            ],
            [
                'name' => 'Sound System Digital Masjid',
                'category_ziswaf' => 'infaq',
                'target_amount' => 25000000,
                'current_amount' => 8750000,
                'start_date' => Carbon::now()->subMonth()->format('Y-m-d'),
                'end_date' => Carbon::now()->addMonths(5)->format('Y-m-d'),
                'status' => 'active',
                'description' => 'Upgrade sistem pengeras suara masjid ke digital. Termasuk mixer, speaker, dan instalasi.',
            ],
        ];

        foreach ($targets as $target) {
            DonationTarget::firstOrCreate(
                ['name' => $target['name']],
                $target
            );
        }

        $this->command->info('Seeded ' . count($targets) . ' donation targets.');
    }

    /**
     * Generate realistic Indonesian Rupiah amounts (rounded to common values).
     */
    private function generateRealisticAmount(int $min, int $max): float
    {
        $amount = rand($min, $max);

        // Round to nearest 5000 or 10000 for realistic amounts
        if ($amount >= 1000000) {
            $amount = round($amount / 100000) * 100000; // Round to nearest 100k
        } elseif ($amount >= 100000) {
            $amount = round($amount / 50000) * 50000; // Round to nearest 50k
        } else {
            $amount = round($amount / 10000) * 10000; // Round to nearest 10k
        }

        return (float) max($amount, $min);
    }

    /**
     * Generate contextual keterangan (description) for a transaction.
     */
    private function generateKeterangan(string $categoryDetail, float $nominal): ?string
    {
        $descriptions = [
            'Infaq Jumat' => [
                'Pengumpulan infaq sholat Jumat',
                'Kotak amal sholat Jumat',
                'Total perolehan infaq Jumat pekan ini',
            ],
            'Zakat Fitrah' => [
                'Zakat fitrah dari warga RT {rt}',
                'Pembayaran zakat fitrah keluarga',
            ],
            'Zakat Maal' => [
                'Zakat maal harta simpanan',
                'Zakat maal penghasilan bulanan',
            ],
            'Listrik Masjid' => [
                'Pembayaran listrik bulan ini',
                'Tagihan PLN masjid',
            ],
            'Honor Imam & Muadzin' => [
                'Honor imam dan muadzin bulan ini',
                'Bisyaroh imam sholat 5 waktu',
            ],
            'Air PDAM' => [
                'Tagihan PDAM bulan ini',
                'Pembayaran air masjid',
            ],
            'Donasi Operasional Umum' => [
                'Donasi dari jamaah untuk operasional',
                'Sumbangan operasional masjid',
            ],
        ];

        // 30% chance of no keterangan
        if (rand(1, 100) <= 30) {
            return null;
        }

        if (isset($descriptions[$categoryDetail])) {
            $desc = $descriptions[$categoryDetail][array_rand($descriptions[$categoryDetail])];
            return str_replace('{rt}', str_pad(rand(1, 15), 2, '0', STR_PAD_LEFT), $desc);
        }

        return null;
    }
}
