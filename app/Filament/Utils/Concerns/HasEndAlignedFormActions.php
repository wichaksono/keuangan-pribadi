<?php

namespace App\Filament\Utils\Concerns;


use Filament\Support\Enums\Alignment;

trait HasEndAlignedFormActions
{
    public function getFormActionsAlignment(): string|Alignment
    {
        return Alignment::End;
    }
}
