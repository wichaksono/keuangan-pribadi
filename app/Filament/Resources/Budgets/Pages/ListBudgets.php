<?php

namespace App\Filament\Resources\Budgets\Pages;

use App\Filament\Resources\Budgets\BudgetResource;
use App\Filament\Utils\Actions\AddNewAction;
use Filament\Resources\Pages\ListRecords;

class ListBudgets extends ListRecords
{
    protected static string $resource = BudgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            AddNewAction::make(),
        ];
    }
}
