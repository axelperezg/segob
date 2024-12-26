<?php

namespace App\Filament\Resources\DependencyResource\Pages;

use App\Filament\Resources\DependencyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDependency extends CreateRecord
{
    protected static string $resource = DependencyResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
