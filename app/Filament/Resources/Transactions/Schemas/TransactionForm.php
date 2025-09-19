<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Enums\TransactionType;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Select::make('type')
                    ->options(TransactionType::class)
                    ->required(),
                DatePicker::make('date')
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                Select::make('account_id')
                    ->relationship('account', 'name')
                    ->required(),
                TextInput::make('created_by')
                    ->required()
                    ->numeric(),
                Textarea::make('attachments')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
