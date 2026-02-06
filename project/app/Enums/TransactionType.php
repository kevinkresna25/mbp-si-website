<?php

namespace App\Enums;

enum TransactionType: string
{
    case Debit = 'debit';
    case Credit = 'credit';

    public function label(): string
    {
        return match ($this) {
            self::Debit => 'Pemasukan',
            self::Credit => 'Pengeluaran',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Debit => 'success',
            self::Credit => 'danger',
        };
    }
}
