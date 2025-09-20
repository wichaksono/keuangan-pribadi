<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use App\Filament\Utils\Actions\BackAction;
use App\Filament\Utils\Actions\HeaderSaveOrCreateAction;
use App\Filament\Utils\Concerns\HasEndAlignedFormActions;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    use HasEndAlignedFormActions;

    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            BackAction::make(),
            HeaderSaveOrCreateAction::make(),
            ViewAction::make(),
            ActionGroup::make([
                DeleteAction::make(),
            ])
        ];
    }
}
