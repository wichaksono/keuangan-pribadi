<?php

namespace App\Filament\Utils\Concerns;

trait PreventsCreatingAnother
{
    public function canCreateAnother(): bool
    {
        return false;
    }
}
