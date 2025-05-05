<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Enums\Documents\DocumentTypeEnum;
use App\Filament\Resources\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDocument extends EditRecord
{
    protected static string $resource = DocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Editar documento';
    }

    public function mutateFormDataBeforeFill(array $data): array
    {
        $data['square_image'] = $data['image'];
        $data['rectangular_image'] = $data['image'];
        return $data;
    }
    
    public function mutateFormDataBeforeSave(array $data): array
    {
        $data['image'] = (int) $data['type'] === DocumentTypeEnum::INFOGRAPHIC->value 
            ? $data['square_image'] 
            : $data['rectangular_image'];

        return $data;
    }

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
