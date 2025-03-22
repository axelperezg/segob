<?php

namespace App\Filament\Resources\MexicoNewsResource\Pages;

use App\Filament\Resources\MexicoNewsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMexicoNews extends CreateRecord
{
    protected static string $resource = MexicoNewsResource::class;

    public function getTitle(): string
    {
        return 'Crear noticia';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
} 