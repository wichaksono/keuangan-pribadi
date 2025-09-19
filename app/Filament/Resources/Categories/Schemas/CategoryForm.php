<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Enums\TransactionType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CategoryForm
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
                Select::make('type')
                    ->options(TransactionType::class)
                    ->required(),
                Select::make('parent_id')
                    ->relationship('parent', 'name'),
                TextInput::make('order_column')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('depth')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
