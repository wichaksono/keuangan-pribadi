<?php

namespace App\Filament\Utils\Actions;

use Closure;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\Page;

/**
 * @extends Action<Page>
 */
class HeaderSaveOrCreateAction extends Action
{
    protected string|array|Closure|null $color = 'primary';

    public static function getDefaultName(): ?string
    {
        return 'saveOrCreate';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(fn(CreateRecord|EditRecord $livewire) => $livewire->record ? 'Save changes' : 'Create')
            ->action(function (CreateRecord|EditRecord $livewire) {
                if ($livewire->record) {
                    $livewire->save();
                } else {
                    $livewire->create();
                }
            })
            ->keyBindings(['mod+s']);
    }
}
