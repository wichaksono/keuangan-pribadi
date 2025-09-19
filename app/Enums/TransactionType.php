<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum TransactionType: string implements HasLabel, HasColor
{

    case INCOME  = 'income';
    case EXPENSE = 'expense';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::INCOME  => 'success',
            self::EXPENSE => 'danger',
        };
    }

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::INCOME  => 'Income',
            self::EXPENSE => 'Expense',
        };
    }
}
