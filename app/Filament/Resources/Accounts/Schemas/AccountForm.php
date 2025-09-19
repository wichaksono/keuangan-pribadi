<?php

namespace App\Filament\Resources\Accounts\Schemas;

use App\Enums\AccountType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('type')
                    ->options(AccountType::class)
                    ->required(),
                TextInput::make('balance')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('currency')
                    ->required()
                    ->default('IDR'),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('created_by')
                    ->required()
                    ->numeric(),
            ]);
    }
}
