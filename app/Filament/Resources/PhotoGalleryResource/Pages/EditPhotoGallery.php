<?php

namespace App\Filament\Resources\PhotoGalleryResource\Pages;

use App\Filament\Resources\PhotoGalleryResource;
use App\Models\PhotoGallery;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use RalphJSmit\Laravel\SEO\Models\SEO;

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

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $seo = SEO::where('model_id', $this->record->id)->where('model_type', PhotoGallery::class)->first();
        
        $data['meta_title'] = $seo?->title;
        $data['meta_description'] = $seo?->description;

        return $data;
    }

    protected function afterSave(): void
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
