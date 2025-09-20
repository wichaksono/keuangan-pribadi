<?php

namespace App\Filament\Utils\Actions;

use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Icons\Heroicon;

class BackAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'back';
    }

    public static function make(?string $name = null): static
    {
        return parent::make($name)
            ->label('Back')
            ->icon(Heroicon::OutlinedArrowLeft)
            ->color('gray')
            ->visible(fn($livewire) => $livewire instanceof CreateRecord
                || $livewire instanceof EditRecord
                || $livewire instanceof ViewRecord)
            ->url(fn($livewire) => $livewire->getResource()::getUrl('index'));
    }
}
