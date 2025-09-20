<?php

namespace App\Filament\Resources\Reminders\Pages;

use App\Filament\Resources\Reminders\ReminderResource;
use App\Filament\Utils\Actions\BackAction;
use App\Filament\Utils\Actions\HeaderSaveOrCreateAction;
use App\Filament\Utils\Concerns\HasEndAlignedFormActions;
use App\Filament\Utils\Concerns\PreventsCreatingAnother;
use Filament\Resources\Pages\CreateRecord;

class CreateReminder extends CreateRecord
{
    use HasEndAlignedFormActions, PreventsCreatingAnother;

    protected static string $resource = ReminderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            BackAction::make(),
            HeaderSaveOrCreateAction::make(),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        return $data;
    }
}
