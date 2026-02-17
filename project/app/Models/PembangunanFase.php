<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PembangunanFase extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'pembangunan_fase';

    protected $fillable = [
        'nama_fase',
        'deskripsi',
        'target_selesai',
        'progress_persen',
        'status',
        'order_column',
        'updated_by',
    ];

    protected $casts = [
        'target_selesai' => 'date',
        'progress_persen' => 'integer',
    ];

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class , 'updated_by');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
                'not_started' => 'Belum Dimulai',
                'in_progress' => 'Sedang Berjalan',
                'completed' => 'Selesai',
                default => $this->status,
            };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
                'not_started' => 'gray',
                'in_progress' => 'yellow',
                'completed' => 'green',
                default => 'gray',
            };
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(300);

        $this->addMediaConversion('medium')
            ->width(800)
            ->height(600);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('masterplan');
        $this->addMediaCollection('progress_photos');
    }

    public static function getOverallProgress(): float
    {
        $avg = self::query()->avg('progress_persen');

        return $avg ? round($avg, 1) : 0;
    }
}
