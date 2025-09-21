<?php

namespace App\Filament\Resources\Reminders\Schemas;

use App\Enums\ReminderPriority;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ReminderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Detail Pengingat')
                    ->aside()
                    ->description('Isi detail pengingat Anda di bawah ini. Pastikan untuk memberikan informasi yang jelas dan tepat waktu.')
                    ->columns()
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->label('Judul Pengingat')
                            ->helperText('Berikan judul yang jelas untuk pengingat ini.')
                            ->columnSpanFull(),

                        Group::make([
                            DatePicker::make('reminder_at')
                                ->required()
                                ->label('Tanggal Pengingat'),
                            Select::make('priority')
                                ->options(ReminderPriority::class)
                                ->default(ReminderPriority::NORMAL)
                                ->required()
                                ->label('Prioritas'),
                            Toggle::make('is_completed')
                                ->visible(fn($operation) => $operation === 'edit')
                                ->inline(false)
                                ->required()
                                ->label('Selesai'),
                        ])->columns(fn($operation) => $operation === 'edit' ? 3 : 2)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->default(null)
                            ->label('Deskripsi')
                            ->columnSpanFull()
                            ->helperText('Jelaskan detail pengingat secara singkat.'),

                        Select::make('assigns') // Ganti user_id menjadi nama relasi (assigns)
                        ->label('Ditugaskan ke')
                            ->multiple()
                            ->relationship('assigns', 'name') // Ganti 'assigns.user' menjadi 'assigns'
                            ->preload()
                            ->searchable()
                            ->columnSpanFull(),

                    ]),
            ]);
    }
}
