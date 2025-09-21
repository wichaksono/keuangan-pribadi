<?php

namespace App\Filament\Resources\RecurringExpenses;

use App\Filament\Resources\RecurringExpenses\Pages\CreateRecurringExpense;
use App\Filament\Resources\RecurringExpenses\Pages\EditRecurringExpense;
use App\Filament\Resources\RecurringExpenses\Pages\ListRecurringExpenses;
use App\Filament\Resources\RecurringExpenses\Pages\ViewRecurringExpense;
use App\Filament\Resources\RecurringExpenses\Schemas\RecurringExpenseForm;
use App\Filament\Resources\RecurringExpenses\Schemas\RecurringExpenseInfolist;
use App\Filament\Resources\RecurringExpenses\Tables\RecurringExpensesTable;
use App\Models\RecurringExpense;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RecurringExpenseResource extends Resource
{
    protected static ?string $model = RecurringExpense::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowPath;

    protected static string|UnitEnum|null $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 15;

    public static function form(Schema $schema): Schema
    {
        return RecurringExpenseForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RecurringExpenseInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RecurringExpensesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListRecurringExpenses::route('/'),
            'create' => CreateRecurringExpense::route('/create'),
            'view'   => ViewRecurringExpense::route('/{record}'),
            'edit'   => EditRecurringExpense::route('/{record}/edit'),
        ];
    }
}
