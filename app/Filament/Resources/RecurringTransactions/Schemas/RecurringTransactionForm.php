<?php

namespace App\Filament\Resources\RecurringTransactions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RecurringTransactionForm
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
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                TextInput::make('frequency')
                    ->required(),
                Textarea::make('custom_frequency')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date'),
                DatePicker::make('next_date'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
