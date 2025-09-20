<?php

namespace App\Filament\Resources\Budgets\Schemas;

use App\Filament\Utils\Currency;
use App\Filament\Utils\GlobalSettings;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BudgetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Detail Anggaran')
                    ->aside()
                    ->description('Masukkan informasi dasar untuk anggaran ini.')
                    ->columns(2)
                    ->schema([
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->label('Kategori')
                            ->searchable()
                            ->preload()
                            ->placeholder('Pilih kategori anggaran'),
                        TextInput::make('amount')
                            ->required()
                            ->numeric()
                            ->label('Jumlah')
                            ->prefix(Currency::symbol())
                            ->placeholder('Contoh: 500000'),
                        Select::make('month')
                            ->required()
                            ->label('Bulan')
                            ->options(GlobalSettings::getMonths())
                            ->default(date('n')),
                        Select::make('year')
                            ->required()
                            ->label('Tahun')
                            ->options(GlobalSettings::getYears())
                            ->default(date('Y')),
                    ]),
                Section::make('Informasi Tambahan')
                    ->aside()
                    ->description('Tambahkan catatan atau detail tambahan untuk anggaran.')
                    ->schema([
                        Textarea::make('notes')
                            ->label('Catatan')
                            ->default(null)
                            ->rows(3)
                            ->placeholder('Masukkan catatan tambahan di sini.'),
                    ]),
            ]);
    }
}
