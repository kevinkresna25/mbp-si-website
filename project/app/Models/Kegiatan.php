<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';

    protected $fillable = [
        'nama_kegiatan', 'jenis', 'tanggal', 'waktu', 'lokasi',
        'ustadz', 'deskripsi', 'banner_image', 'status', 'created_by',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('tanggal', '>=', now()->startOfDay())
            ->where('status', 'upcoming')
            ->orderBy('tanggal');
    }

    public function scopeByJenis($query, string $jenis)
    {
        return $query->where('jenis', $jenis);
    }

    public function getJenisLabelAttribute(): string
    {
        return match ($this->jenis) {
            'kajian' => 'Kajian Rutin',
            'maulid' => 'Hari Besar Islam',
            'sosial' => 'Program Sosial',
            'remaja' => 'Kegiatan Remaja',
            default => $this->jenis,
        };
    }

    public function getJenisColorAttribute(): string
    {
        return match ($this->jenis) {
            'kajian' => 'emerald',
            'maulid' => 'amber',
            'sosial' => 'blue',
            'remaja' => 'purple',
            default => 'gray',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'upcoming' => 'Akan Datang',
            'ongoing' => 'Berlangsung',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => $this->status,
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'upcoming' => 'blue',
            'ongoing' => 'emerald',
            'completed' => 'gray',
            'cancelled' => 'red',
            default => 'gray',
        };
    }
}
