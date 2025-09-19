<?php

namespace App\Filament\Resources\RecurringTransactions\Pages;

use App\Filament\Resources\RecurringTransactions\RecurringTransactionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRecurringTransaction extends ViewRecord
{
    protected static string $resource = RecurringTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
