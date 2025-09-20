<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Filament\Utils\Actions\BackAction;
use App\Filament\Utils\Actions\HeaderSaveOrCreateAction;
use App\Filament\Utils\Concerns\HasEndAlignedFormActions;
use App\Filament\Utils\Concerns\PreventsCreatingAnother;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    use HasEndAlignedFormActions, PreventsCreatingAnother;

    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            BackAction::make(),
            HeaderSaveOrCreateAction::make(),
        ];
    }
}
