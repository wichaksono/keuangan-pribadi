<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ReminderPriority: string implements HasLabel, HasColor
{
    case LOW    = 'low';
    case NORMAL = 'normal';
    case HIGH   = 'high';
    case URGENT = 'urgent';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::LOW    => 'Low',
            self::NORMAL => 'Normal',
            self::HIGH   => 'High',
            self::URGENT => 'Urgent',
        };
    }

    public function getColor(): array|string|null
    {
        return match ($this) {
            self::LOW    => 'gray',
            self::NORMAL => 'success',
            self::HIGH   => 'danger',
            self::URGENT => Color::Rose,
        };
    }

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
