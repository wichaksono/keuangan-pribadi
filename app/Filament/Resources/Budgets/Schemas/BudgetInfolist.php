<?php

namespace App\Filament\Resources\Budgets\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BudgetInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('category.name')
                    ->label('Category'),
                TextEntry::make('amount')
                    ->numeric(),
                TextEntry::make('month')
                    ->numeric(),
                TextEntry::make('year')
                    ->numeric(),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_by')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
