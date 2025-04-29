<?php

namespace App\Filament\Resources\PhotoGalleryResource\Pages;

use App\Filament\Resources\PhotoGalleryResource;
use App\Models\PhotoGallery;
use Filament\Resources\Pages\CreateRecord;
use RalphJSmit\Laravel\SEO\Models\SEO;

class CreatePhotoGallery extends CreateRecord
{
    protected static string $resource = PhotoGalleryResource::class;

    public function getTitle(): string
    {
        return 'Crear galería';
    }

    protected function afterCreate(): void
    {
        SEO::updateOrCreate([
            'model_id' => $this->record->id,
            'model_type' => PhotoGallery::class,
        ], [
            'title' => $this->data['meta_title'],
            'description' => $this->data['meta_description'],
        ]);
    }
    
}
