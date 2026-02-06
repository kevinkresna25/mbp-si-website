<?php

namespace App\Enums;

enum CategoryZiswaf: string
{
    case Zakat = 'zakat';
    case Infaq = 'infaq';
    case Sedekah = 'sedekah';
    case Wakaf = 'wakaf';
    case Operasional = 'operasional';

    public function label(): string
    {
        return match ($this) {
            self::Zakat => 'Zakat',
            self::Infaq => 'Infaq',
            self::Sedekah => 'Sedekah',
            self::Wakaf => 'Wakaf',
            self::Operasional => 'Operasional',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Zakat => 'Harus disalurkan ke 8 golongan mustahiq',
            self::Infaq => 'Dapat digunakan untuk operasional dan program masjid',
            self::Sedekah => 'Dapat digunakan untuk program sosial',
            self::Wakaf => 'Untuk aset jangka panjang (tanah, bangunan)',
            self::Operasional => 'Dana operasional dari sumber non-zakat',
        };
    }

    public function canBeUsedFor(string $purpose): bool
    {
        return match ($this) {
            self::Zakat => in_array($purpose, ['mustahiq', 'social']),
            self::Infaq => in_array($purpose, ['operational', 'program', 'social']),
            self::Sedekah => in_array($purpose, ['operational', 'social']),
            self::Wakaf => in_array($purpose, ['asset', 'construction']),
            self::Operasional => in_array($purpose, ['operational', 'maintenance']),
        };
    }
}
