<?php

namespace App\Filament\Resources\RecurringTransactions\Pages;

use App\Filament\Resources\RecurringTransactions\RecurringTransactionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRecurringTransaction extends EditRecord
{
    protected static string $resource = RecurringTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
