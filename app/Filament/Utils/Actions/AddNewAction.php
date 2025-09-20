<?php

namespace App\Filament\Utils\Actions;

use BackedEnum;
use Closure;
use Filament\Actions\CreateAction;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;

class AddNewAction extends CreateAction
{

    protected string|BackedEnum|Htmlable|Closure|false|null $icon = Heroicon::OutlinedPlusCircle;


    protected function setUp(): void
    {
        parent::setUp();

        $this->label(fn(): string => $this->getModelLabel());
    }

    public function getModelLabel(): string
    {
        return 'Add New';
    }
}
