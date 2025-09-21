<?php

namespace App\Filament\Resources\RecurringExpenses\Pages;

use App\Filament\Resources\RecurringExpenses\RecurringExpenseResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRecurringExpense extends ViewRecord
{
    protected static string $resource = RecurringExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
