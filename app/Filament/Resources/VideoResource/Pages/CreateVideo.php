<?php

namespace App\Filament\Resources\VideoResource\Pages;

use App\Filament\Resources\VideoResource;
use Filament\Resources\Pages\CreateRecord;
use RalphJSmit\Laravel\SEO\Models\SEO;
use App\Models\Video;

class CreateVideo extends CreateRecord
{
    protected static string $resource = VideoResource::class;

    public function getTitle(): string
    {
        return 'Crear video';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        SEO::updateOrCreate([
            'model_id' => $this->record->id,
            'model_type' => Video::class,
        ], [
            'title' => $this->data['meta_title'],
            'description' => $this->data['meta_description'],
        ]);
    }
    
}
