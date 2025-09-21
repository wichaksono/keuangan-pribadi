<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum TransactionEntiryType: string implements HasLabel, HasColor
{
    case DEBIT  = 'debit';
    case CREDIT = 'credit';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::DEBIT  => 'danger',
            self::CREDIT => 'success',
        };
    }

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::DEBIT  => 'Debit',
            self::CREDIT => 'Credit',
        };
    }
}
