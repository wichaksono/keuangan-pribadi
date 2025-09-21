<?php

namespace App\Filament\Resources\Budgets\Tables;

use App\Filament\Utils\Currency;
use App\Models\Budget;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;

class BudgetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->groups([
                Group::make('month')
                    ->getTitleFromRecordUsing(fn(Budget $record) => $record->month_name),
            ])
            ->columns([
                TextColumn::make('category.name')
                    ->searchable(),
                TextColumn::make('amount')
                    ->numeric()
                    ->prefix(Currency::symbol())
                    ->alignEnd()
                    ->sortable(),
                TextColumn::make('month')
                    ->formatStateUsing(fn(Budget $record) => $record->month_name)
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('year')
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
                TernaryFilter::make('current_year')
                    ->label('Current Year')
                    ->trueLabel(date('Y'))
                    ->default(true)
                    ->queries(
                        true: fn($query) => $query->where('year', now()->year),
                        false: fn($query) => $query->where('year', '<>', now()->year),
                        blank: fn($query) => $query,
                    ),

                TernaryFilter::make('current_month')
                    ->label('Current Month')
                    ->trueLabel(date('F'))
                    ->default(true)
                    ->queries(
                        true: fn($query) => $query->where('year', now()->year)->where('month', now()->month),
                        false: fn($query) => $query->where(fn($q) => $q->where('year', '<>', now()->year)
                            ->orWhere('month', '<>', now()->month)
                        ),
                        blank: fn($query) => $query,
                    ),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
