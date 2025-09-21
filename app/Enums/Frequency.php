<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum Frequency: string implements HasLabel, HasColor
{
    //'daily', 'weekly', 'monthly', 'yearly'
    case DAILY   = 'daily';
    case WEEKLY  = 'weekly';
    case MONTHLY = 'monthly';
    case YEARLY  = 'yearly';
    case CUSTOM  = 'custom';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::DAILY   => 'Daily',
            self::WEEKLY  => 'Weekly',
            self::MONTHLY => 'Monthly',
            self::YEARLY  => 'Yearly',
            self::CUSTOM  => 'Custom',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::DAILY   => 'info',
            self::WEEKLY  => 'primary',
            self::MONTHLY => 'warning',
            self::YEARLY  => 'success',
            self::CUSTOM  => 'secondary',
        };
    }

    // toUnit
    public function toUnit(): string
    {
        return match ($this) {
            self::DAILY   => 'days',
            self::WEEKLY  => 'weeks',
            self::MONTHLY => 'months',
            self::YEARLY  => 'years',
            self::CUSTOM  => 'custom',
        };
    }
}
