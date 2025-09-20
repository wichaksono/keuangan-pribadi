<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use App\Filament\Utils\Actions\BackAction;
use App\Filament\Utils\Actions\HeaderSaveOrCreateAction;
use App\Filament\Utils\Concerns\HasEndAlignedFormActions;
use App\Filament\Utils\Concerns\PreventsCreatingAnother;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    use HasEndAlignedFormActions, PreventsCreatingAnother;

    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            BackAction::make(),
            HeaderSaveOrCreateAction::make(),
        ];
    }
}
