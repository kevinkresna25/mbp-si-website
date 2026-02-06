<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KutipanHikmah extends Model
{
    protected $fillable = ['kutipan_text', 'sumber', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
