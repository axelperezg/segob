<?php

namespace App\Filament\Resources\AudioResource\Pages;

use App\Filament\Resources\AudioResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAudio extends CreateRecord
{
    protected static string $resource = AudioResource::class;

    public function getTitle(): string
    {
        return 'Crear audio';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
