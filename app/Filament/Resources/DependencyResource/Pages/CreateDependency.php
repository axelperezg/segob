<?php

namespace App\Filament\Resources\DependencyResource\Pages;

use App\Filament\Resources\DependencyResource;
use App\Models\Dependency;
use Filament\Resources\Pages\CreateRecord;
use RalphJSmit\Laravel\SEO\Models\SEO;

class CreateDependency extends CreateRecord
{
    protected static string $resource = DependencyResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        SEO::updateOrCreate([
            'model_id' => $this->record->id,
            'model_type' => Dependency::class,
        ], [
            'title' => $this->data['meta_title'],
            'description' => $this->data['meta_description'],
        ]);
    }
}
