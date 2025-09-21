<?php

namespace App\Filament\Resources\RecurringExpenses\Pages;

use App\Filament\Resources\RecurringExpenses\RecurringExpenseResource;
use App\Filament\Utils\Actions\AddNewAction;
use Filament\Resources\Pages\ListRecords;

class ListRecurringExpenses extends ListRecords
{
    protected static string $resource = RecurringExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            AddNewAction::make(),
        ];
    }
}
