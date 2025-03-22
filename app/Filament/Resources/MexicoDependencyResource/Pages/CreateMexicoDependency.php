<?php

namespace App\Filament\Resources\MexicoDependencyResource\Pages;

use App\Filament\Resources\MexicoDependencyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMexicoDependency extends CreateRecord
{
    protected static string $resource = MexicoDependencyResource::class;

    public function getTitle(): string
    {
        return 'Crear dependencia';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
} 