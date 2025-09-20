<?php

namespace App\Filament\Resources\Reminders\Pages;

use App\Filament\Resources\Reminders\ReminderResource;
use App\Filament\Utils\Actions\AddNewAction;
use App\Filament\Utils\Actions\BackAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewReminder extends ViewRecord
{
    protected static string $resource = ReminderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            BackAction::make(),
            AddNewAction::make(),
            EditAction::make(),
        ];
    }
}
