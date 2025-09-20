<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Filament\Utils\Actions\BackAction;
use App\Filament\Utils\Actions\HeaderSaveOrCreateAction;
use App\Filament\Utils\Concerns\HasEndAlignedFormActions;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    use HasEndAlignedFormActions;

    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            BackAction::make(),
            ViewAction::make(),
            HeaderSaveOrCreateAction::make(),
            ActionGroup::make([
                DeleteAction::make(),
            ])
        ];
    }
}
