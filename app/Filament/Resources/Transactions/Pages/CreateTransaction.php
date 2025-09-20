<?php

namespace App\Filament\Resources\Transactions\Pages;

use App\Enums\TransactionType;
use App\Filament\Resources\Transactions\TransactionResource;
use App\Filament\Utils\Actions\BackAction;
use App\Filament\Utils\Actions\HeaderSaveOrCreateAction;
use App\Filament\Utils\Concerns\HasEndAlignedFormActions;
use App\Filament\Utils\Concerns\PreventsCreatingAnother;
use Filament\Resources\Pages\CreateRecord;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CreateTransaction extends CreateRecord
{
    use HasEndAlignedFormActions, PreventsCreatingAnother;

    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            BackAction::make(),
            HeaderSaveOrCreateAction::make(),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type']       = $data['_type'] ?? $data['type'];
        $data['created_by'] = auth()->id();
        return $data;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function afterFill(): void
    {
        $type = request()->get('type');
        if ($type && in_array($type, array_column(TransactionType::cases(), 'value'))) {
            $this->data['_type'] = $type;
        }
    }
}
