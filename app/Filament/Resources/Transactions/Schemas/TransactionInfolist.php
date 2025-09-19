<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('title'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('amount')
                    ->numeric(),
                TextEntry::make('type')
                    ->badge(),
                TextEntry::make('date')
                    ->date(),
                TextEntry::make('category.name')
                    ->label('Category'),
                TextEntry::make('account.name')
                    ->label('Account'),
                TextEntry::make('created_by')
                    ->numeric(),
                TextEntry::make('attachments')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
