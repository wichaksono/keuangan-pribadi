<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Filament\Utils\Actions\AddNewAction;
use App\Filament\Utils\Actions\BackAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            BackAction::make(),
            AddNewAction::make(),
            EditAction::make(),
        ];
    }
}
