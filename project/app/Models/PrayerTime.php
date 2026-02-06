<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrayerTime extends Model
{
    protected $fillable = ['tanggal', 'subuh', 'dzuhur', 'ashar', 'maghrib', 'isya', 'imsak'];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }
}
