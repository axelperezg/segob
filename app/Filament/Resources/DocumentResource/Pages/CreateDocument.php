<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Enums\Documents\DocumentTypeEnum;
use App\Filament\Resources\DocumentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDocument extends CreateRecord
{
    protected static string $resource = DocumentResource::class;

    public function getTitle(): string
    {
        return 'Crear documento';
    }

    public function mutateFormDataBeforeCreate(array $data): array
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
