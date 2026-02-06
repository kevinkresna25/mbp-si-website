<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Enums\TransactionType;
use App\Enums\CategoryZiswaf;
use App\Enums\TransactionStatus;

class Transaction extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'transaction_code', 'tanggal', 'type', 'category_ziswaf', 'category_detail',
        'nominal', 'keterangan', 'bukti_foto', 'status', 'rejection_reason',
        'created_by', 'approved_by', 'approved_at',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'nominal' => 'decimal:2',
        'type' => TransactionType::class,
        'category_ziswaf' => CategoryZiswaf::class,
        'status' => TransactionStatus::class,
        'approved_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['tanggal', 'type', 'category_ziswaf', 'category_detail', 'nominal', 'keterangan', 'status', 'approved_by', 'approved_at'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', TransactionStatus::Approved);
    }

    public function scopePendingApproval($query)
    {
        return $query->where('status', TransactionStatus::Submitted);
    }

    public function scopeByZiswaf($query, string $category)
    {
        return $query->where('category_ziswaf', $category);
    }

    public function scopeDebit($query)
    {
        return $query->where('type', TransactionType::Debit);
    }

    public function scopeCredit($query)
    {
        return $query->where('type', TransactionType::Credit);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($transaction) {
            if (empty($transaction->transaction_code)) {
                $transaction->transaction_code = self::generateTransactionCode();
            }
        });
    }

    public static function generateTransactionCode(): string
    {
        $date = now()->format('Ymd');
        $lastTransaction = self::whereDate('created_at', now())->orderBy('id', 'desc')->first();
        $sequence = $lastTransaction ? ((int) substr($lastTransaction->transaction_code, -3)) + 1 : 1;
        return 'TRX-' . $date . '-' . str_pad($sequence, 3, '0', STR_PAD_LEFT);
    }
}
