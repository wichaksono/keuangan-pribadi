<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum Frequency: string implements HasLabel, HasColor
{
    //'daily', 'weekly', 'monthly', 'yearly'
    case Daily   = 'daily';
    case Weekly  = 'weekly';
    case Monthly = 'monthly';
    case Yearly  = 'yearly';
    case Custom  = 'custom';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Daily   => 'Daily',
            self::Weekly  => 'Weekly',
            self::Monthly => 'Monthly',
            self::Yearly  => 'Yearly',
            self::Custom  => 'Custom',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Daily   => 'info',
            self::Weekly  => 'primary',
            self::Monthly => 'warning',
            self::Yearly  => 'success',
            self::Custom  => 'secondary',
        };
    }

    // toUnit
    public function toUnit(): string
    {
        return match ($this) {
            self::Daily   => 'days',
            self::Weekly  => 'weeks',
            self::Monthly => 'months',
            self::Yearly  => 'years',
            self::Custom  => 'custom',
        };
    }
}
