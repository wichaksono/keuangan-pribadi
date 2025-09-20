<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Enums\TransactionType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Informasi Kategori')
                    ->aside()
                    ->description('Detail umum tentang kategori.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->label('Nama Kategori'),
                        Select::make('type')
                            ->options(TransactionType::class)
                            ->required()
                            ->label('Tipe Transaksi')
                            ->helperText('Pilih apakah kategori ini untuk Pemasukan atau Pengeluaran.')
                            ->reactive(),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->default(null)
                            ->placeholder('Masukkan deskripsi singkat tentang kategori.')
                            ->columnSpanFull(),
                        Select::make('parent_id')
                            ->relationship('parent', 'name', function (Builder $query, Get $get, $record) {
                                $type = $get('type');
                                if ($type) {
                                    $query->where('type', $type);
                                }

                                if ($record) {
                                    $query->where('id', '!=', $record->id);
                                }

                                return $query;
                            })
                            ->label('Kategori Induk')
                            ->placeholder('Pilih kategori induk (opsional)'),
                    ]),
            ]);
    }
}
