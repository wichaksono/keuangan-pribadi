<?php

namespace App\Filament\Resources\RecurringExpenses\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RecurringExpenseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('name'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('account_id')
                    ->placeholder('-'),
                TextEntry::make('amount')
                    ->numeric(),
                TextEntry::make('start_date')
                    ->date(),
                TextEntry::make('end_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('frequency'),
                IconEntry::make('is_active')
                    ->boolean(),
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
