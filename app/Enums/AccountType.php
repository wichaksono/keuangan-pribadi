<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum AccountType: string implements HasLabel, HasColor
{
    case CASH       = 'cash';
    case BANK       = 'bank';
    case EWALLET    = 'ewallet';
    case SAVING     = 'saving';
    case DEBT       = 'debt';
    case RECEIVABLE = 'receivable';

    public function getLabel(): string
    {
        return match ($this) {
            self::CASH       => 'Cash',
            self::BANK       => 'Bank',
            self::EWALLET    => 'E-Wallet',
            self::SAVING     => 'Saving',
            self::DEBT       => 'Debt',
            self::RECEIVABLE => 'Receivable',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::CASH       => 'success',
            self::BANK       => 'primary',
            self::EWALLET    => 'warning',
            self::SAVING     => 'info',
            self::DEBT       => 'danger',
            self::RECEIVABLE => 'secondary',
        };
    }
}
