<?php

namespace App\Filament\Resources\PhotoGalleryResource\Pages;

use App\Filament\Resources\PhotoGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPhotoGallery extends EditRecord
{
    protected static string $resource = PhotoGalleryResource::class;

    public function getTitle(): string
    {
        return 'Editar galería';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
