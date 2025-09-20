<?php

namespace App\Filament\Resources\RecurringTransactions\Schemas;

use App\Enums\Frequency;
use App\Enums\TransactionType;
use App\Filament\Utils\Currency;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class RecurringTransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Recurring Transaction Details')
                    ->columns()
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        Select::make('category_id')
                            ->relationship('category', 'name', function ($query) {
                                return $query->where('type', TransactionType::EXPENSE);
                            })
                            ->required(),
                        Textarea::make('description')
                            ->default(null)
                            ->columnSpanFull(),
                        TextInput::make('amount')
                            ->required()
                            ->numeric()
                            ->prefix(Currency::symbol())
                            ->columnSpanFull(),
                        DatePicker::make('start_date')
                            ->default(now())
                            ->required(),
                        DatePicker::make('end_date'),
                        DatePicker::make('next_date'),
                        Toggle::make('is_active')
                            ->inline(false)
                            ->default(true)
                            ->required(),
                    ]),
                Section::make('Frequency')
                    ->columns(1)
                    ->schema([
                        Select::make('frequency')
                            ->hiddenLabel()
                            ->native(false)
                            ->options(Frequency::class)
                            ->default(Frequency::Monthly)
                            ->reactive()
                            ->required(),
                        Section::make('Custom Frequency')
                            ->label('Repeat Rules')
                            ->visible(fn(Get $get) => $get('frequency') === Frequency::Custom)
                            ->columns()
                            ->schema([
                                Select::make('custom_frequency.frequency')
                                    ->options(Frequency::class)
                                    ->required()
                                    ->label('Frequency'),

                                TextInput::make('custom_frequency.interval')
                                    ->numeric()
                                    ->default(1)
                                    ->label('Interval')
                                    ->helperText('E.g., every 2 weeks, set interval to 2'),
                            ]),
                    ]),
            ]);
    }
}
