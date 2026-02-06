<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Struktur extends Model
{
    protected $table = 'struktur';

    protected $fillable = ['nama', 'jabatan', 'foto', 'kontak', 'order_column'];

    protected static function booted(): void
    {
        static::addGlobalScope('ordered', function (Builder $builder) {
            $builder->orderBy('order_column', 'asc');
        });
    }
}
