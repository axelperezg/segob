<?php

namespace App\Filament\Resources\AudioResource\Pages;

use App\Filament\Resources\AudioResource;
use App\Models\Audio;
use Filament\Resources\Pages\CreateRecord;
use RalphJSmit\Laravel\SEO\Models\SEO;

class CreateAudio extends CreateRecord
{
    protected static string $resource = AudioResource::class;

    protected function afterCreate(): void
    {
        SEO::updateOrCreate([
            'model_id' => $this->record->id,
            'model_type' => Audio::class,
        ], [
            'title' => $this->data['meta_title'],
            'description' => $this->data['meta_description'],
        ]);
    }
    
}
