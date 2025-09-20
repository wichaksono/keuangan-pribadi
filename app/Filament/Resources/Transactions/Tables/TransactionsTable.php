<?php

namespace App\Filament\Resources\Transactions\Tables;

use App\Filament\Utils\Currency;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('amount')
                    ->numeric()
                    ->prefix(Currency::symbol())
                    ->alignEnd()
                    ->sortable(),
                TextColumn::make('type')
                    ->badge()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('date')
                    ->date()
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('account.name')
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('creator.name')
                    ->numeric()
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
