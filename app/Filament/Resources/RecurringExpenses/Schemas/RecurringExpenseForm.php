<?php

namespace App\Filament\Resources\RecurringExpenses\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RecurringExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('account_id')
                    ->default(null),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date'),
                TextInput::make('frequency')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('created_by')
                    ->required()
                    ->numeric(),
            ]);
    }
}
