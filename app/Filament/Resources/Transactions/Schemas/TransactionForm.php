<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Enums\AccountType;
use App\Enums\TransactionEntiryType;
use App\Enums\TransactionType;
use App\Filament\Utils\Currency;
use Closure;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([

                Section::make('Detail Transaksi')
                    ->columns(3)
                    ->schema([
                        Group::make([
                            TextInput::make('title')
                                ->required()
                                ->label('Judul Transaksi')
                                ->helperText('Berikan judul yang jelas untuk transaksi ini.')
                                ->columnSpan(2),

                            DatePicker::make('date')
                                ->required()
                                ->label('Tanggal')
                                ->default(now()),
                        ])->columns(3)
                            ->columnSpanFull(),

                        Hidden::make('type')
                            ->default(TransactionType::ADVANCED)
                            ->dehydrated(),

                        Textarea::make('description')
                            ->default(null)
                            ->label('Deskripsi')
                            ->columnSpanFull()
                            ->helperText('Jelaskan detail transaksi secara singkat.'),
                    ])->columnSpan(2),

                Section::make('Attachments')
                    ->schema([
                        FileUpload::make('attachments')
                            ->hiddenLabel()
                            ->multiple()
                            ->default(null)
                            ->label('Lampiran'),
                    ]),
                Section::make('Entries')
                    ->schema([
                        Repeater::make('entries')
                            ->hiddenLabel()
                            ->relationship()
                            ->table([
                                Repeater\TableColumn::make('Debit/Kredit')
                                    ->width('20%'),
                                Repeater\TableColumn::make('Jenis Akun')
                                    ->width('20%'),
                                Repeater\TableColumn::make('Akun')
                                    ->width('30%'),
                                Repeater\TableColumn::make('Jumlah')
                                    ->width('30%'),
                            ])
                            ->schema([
                                Select::make('type')
                                    ->options(TransactionEntiryType::class)
                                    ->placeholder('Pilih Tipe')
                                    ->required(),
                                Select::make('account_type')
                                    ->placeholder('Pilih Jenis')
                                    ->options(AccountType::class)
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn(callable $set) => $set('account_id', null)),
                                Select::make('account_id')
                                    ->disabled(fn(Get $get) => !$get('account_type'))
                                    ->relationship('account', 'name',
                                        function (Get $get, Builder $query) {
                                            if ($get('account_type')) {
                                                $query->where('type', $get('account_type'));
                                            }
                                            $query->where('is_active', true);
                                            $query->orderBy('code');
                                        })
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems(),
                                TextInput::make('amount')
                                    ->numeric()
                                    ->prefix(Currency::symbol())
                                    ->required(),
                            ])
                            ->rules([
                                function () {
                                    return function (string $attribute, $value, Closure $fail) {
                                        $totalDebit  = collect($value)
                                            ->where('type', TransactionEntiryType::DEBIT->value)
                                            ->sum('amount');
                                        $totalCredit = collect($value)
                                            ->where('type', TransactionEntiryType::CREDIT->value)
                                            ->sum('amount');

                                        if ($totalDebit !== $totalCredit) {

                                            $totalCredit = Currency::format($totalCredit);
                                            $totalDebit  = Currency::format($totalDebit);
                                            $fail("Total debit dan total kredit harus seimbang. Total Debit: {$totalDebit}, Total Kredit: {$totalCredit}.");
                                        }
                                    };
                                },
                            ])
                            ->columnSpanFull(),
                    ])->columnSpanFull(),
            ]);
    }
}
