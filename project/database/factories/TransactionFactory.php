<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'transaction_code' => 'TRX-' . now()->format('Ymd') . '-' . str_pad(fake()->unique()->numberBetween(1, 999), 3, '0', STR_PAD_LEFT),
            'tanggal' => fake()->dateTimeBetween('-3 months', 'now'),
            'type' => fake()->randomElement(['debit', 'credit']),
            'category_ziswaf' => fake()->randomElement(['zakat', 'infaq', 'sedekah', 'wakaf', 'operasional']),
            'category_detail' => fake()->randomElement([
                'Infaq Jumat', 'Zakat Fitrah', 'Donasi Pembangunan',
                'Listrik', 'Honor Imam', 'Air', 'Kebersihan',
                'Zakat Maal', 'Sedekah Jum\'at', 'Wakaf Tanah',
            ]),
            'nominal' => fake()->randomFloat(2, 50000, 5000000),
            'keterangan' => fake()->optional(0.7)->sentence(),
            'status' => 'approved',
            'created_by' => User::factory(),
            'approved_by' => User::factory(),
            'approved_at' => now(),
        ];
    }

    /**
     * Transaction in draft status.
     */
    public function draft(): static
    {
        return $this->state(fn () => [
            'status' => 'draft',
            'approved_by' => null,
            'approved_at' => null,
        ]);
    }

    /**
     * Transaction in submitted status.
     */
    public function submitted(): static
    {
        return $this->state(fn () => [
            'status' => 'submitted',
            'approved_by' => null,
            'approved_at' => null,
        ]);
    }

    /**
     * Transaction in rejected status.
     */
    public function rejected(): static
    {
        return $this->state(fn () => [
            'status' => 'rejected',
            'rejection_reason' => fake()->sentence(),
            'approved_by' => User::factory(),
            'approved_at' => now(),
        ]);
    }

    /**
     * Debit (income) transaction.
     */
    public function debit(): static
    {
        return $this->state(fn () => ['type' => 'debit']);
    }

    /**
     * Credit (expense) transaction.
     */
    public function credit(): static
    {
        return $this->state(fn () => ['type' => 'credit']);
    }

    /**
     * Transaction for a specific ZISWAF category.
     */
    public function forCategory(string $category): static
    {
        return $this->state(fn () => ['category_ziswaf' => $category]);
    }
}
