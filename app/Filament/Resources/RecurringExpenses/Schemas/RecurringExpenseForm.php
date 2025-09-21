<?php

namespace App\Filament\Resources\RecurringExpenses\Schemas;

use App\Enums\BillFrequency;
use App\Enums\Frequency;
use App\Filament\Utils\Currency;
use App\Models\RecurringExpense;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class RecurringExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Recurring Expense Details')
                    ->columns()
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        Select::make('account_id')
                            ->label('Kategori Akun')
                            ->options(function () {
                                return RecurringExpense::getAccountsWithGroups();
                            })
                            ->searchable()
                            ->required(),
                        Textarea::make('description')
                            ->default(null)
                            ->columnSpanFull(),
                        TextInput::make('amount')
                            ->required()
                            ->numeric()
                            ->prefix(Currency::symbol())
                            ->columnSpanFull(),
                        DatePicker::make('due_date')
                            ->default(now())
                            ->required(),

                        Toggle::make('is_active')
                            ->inline(false)
                            ->default(true)
                            ->required(),
                    ]),
                Section::make('Reminder')
                    ->columns(2)
                    ->schema([
                        TextInput::make('reminder_at')
                            ->label('Remind Me')
                            ->helperText('Days before due date to remind')
                            ->numeric()
                            ->default(1)
                            ->suffix('Days')
                            ->required(),
                        Select::make('frequency')
                            ->label('Reminder Frequency')
                            ->options(Frequency::class)
                            ->default(Frequency::MONTHLY)
                            ->reactive()
                            ->required(),
                        Section::make('Custom Frequency')
                            ->hiddenLabel()
                            ->contained(false)
                            ->visible(fn(Get $get) => $get('frequency') === Frequency::CUSTOM)
                            ->columns()
                            ->columnSpanFull()
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
