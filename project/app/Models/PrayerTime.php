<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrayerTime extends Model
{
    protected $fillable = ['tanggal', 'subuh', 'terbit', 'dzuhur', 'ashar', 'maghrib', 'isya', 'imsak'];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }
}
