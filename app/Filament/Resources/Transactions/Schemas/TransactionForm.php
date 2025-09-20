<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Enums\TransactionType;
use App\Filament\Utils\Currency;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Hidden::make('_type'),
                Section::make('Detail Transaksi')
                    ->columns(3)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->label('Judul Transaksi')
                            ->helperText('Berikan judul yang jelas untuk transaksi ini.')
                            ->columnSpanFull(),
                        Group::make([
                            TextInput::make('amount')
                                ->required()
                                ->numeric()
                                ->default(0)
                                ->prefix(Currency::symbol())
                                ->label('Jumlah')
                            ->columnSpanFull(),
                        ])->columnSpan(2),

                        DatePicker::make('date')
                            ->required()
                            ->label('Tanggal')
                            ->default(now()),
                        Textarea::make('description')
                            ->default(null)
                            ->label('Deskripsi')
                            ->columnSpanFull()
                            ->helperText('Jelaskan detail transaksi secara singkat.'),
                    ])->columnSpan(2),

                Section::make('Kategori dan Akun')
                    ->schema([
                        Select::make('type')
                            ->options(TransactionType::class)
                            ->required()
                            ->visible(fn(Get $get) => $get('_type') === null)
                            ->label('Tipe'),
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->label('Kategori'),
                        Select::make('account_id')
                            ->relationship('account', 'name')
                            ->required()
                            ->label('Akun'),

                        FileUpload::make('attachments')
                            ->default(null)
                            ->columnSpanFull()
                            ->label('Lampiran'),
                    ]),


            ]);
    }
}
