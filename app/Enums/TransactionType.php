<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;
use function Symfony\Component\String\s;

enum TransactionType: string implements HasLabel, HasColor
{

    case ADVANCED = 'advanced';
    case INCOME   = 'income';
    case EXPENSE    = 'expense';
    case ADJUSTMENT = 'adjustment';
    case TRANSFER   = 'transfer';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::ADVANCED   => 'secondary',
            self::INCOME     => 'success',
            self::EXPENSE    => 'danger',
            self::ADJUSTMENT => 'primary',
            self::TRANSFER   => 'warning',
        };
    }

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::ADVANCED   => 'Advanced',
            self::INCOME     => 'Income',
            self::EXPENSE    => 'Expense',
            self::ADJUSTMENT => 'Adjustment',
            self::TRANSFER   => 'Transfer',
        };
    }
}
