<?php

namespace App\Filament\Resources\Budgets\Pages;

use App\Filament\Resources\Budgets\BudgetResource;
use App\Filament\Utils\Actions\AddNewAction;
use App\Filament\Utils\Actions\BackAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBudget extends ViewRecord
{
    protected static string $resource = BudgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            BackAction::make(),
            AddNewAction::make(),
            EditAction::make(),
        ];
    }
}
