<?php

namespace App\Filament\Resources\Transactions\Tables;

use App\Filament\Utils\Currency;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->date()
                    ->sortable(),

                TextColumn::make('title')
                    ->searchable(),

                TextColumn::make('totalDebit')
                    ->label('Debit')
                    ->numeric()
                    ->prefix(Currency::symbol())
                    ->alignEnd()
                    ->sortable(),
                TextColumn::make('totalCredit')
                    ->label('Kredit')
                    ->numeric()
                    ->prefix(Currency::symbol())
                    ->alignEnd()
                    ->sortable(),
                TextColumn::make('creator.name')
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
            ]);
    }
}
