<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\CategoryZiswaf;

class DonationTarget extends Model
{
    protected $fillable = [
        'name', 'category_ziswaf', 'target_amount', 'current_amount',
        'start_date', 'end_date', 'status', 'description',
    ];

    protected $casts = [
        'category_ziswaf' => CategoryZiswaf::class ,
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function getProgressPercentAttribute(): float
    {
        if ($this->target_amount <= 0) {
            return 0;
        }
        return min(100, round(($this->current_amount / $this->target_amount) * 100, 1));
    }

    public const STATUS_ACTIVE = 'active';

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }
}
