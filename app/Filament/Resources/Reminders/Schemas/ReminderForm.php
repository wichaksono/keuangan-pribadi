<?php

namespace App\Filament\Resources\Reminders\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ReminderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('reference_type')
                    ->default(null),
                TextInput::make('reference_id')
                    ->default(null),
                DatePicker::make('reminder_at')
                    ->required(),
                Toggle::make('is_completed')
                    ->required(),
                TextInput::make('created_by')
                    ->required()
                    ->numeric(),
            ]);
    }
}
