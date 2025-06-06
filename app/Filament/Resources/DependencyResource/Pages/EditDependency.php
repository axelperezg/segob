<?php

namespace App\Filament\Resources\DependencyResource\Pages;

use App\Filament\Resources\DependencyResource;
use App\Models\Dependency;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use RalphJSmit\Laravel\SEO\Models\SEO;

class EditDependency extends EditRecord
{
    protected static string $resource = DependencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $seo = SEO::where('model_id', $this->record->id)->where('model_type', Dependency::class)->first();
        
        $data['meta_title'] = $seo?->title;
        $data['meta_description'] = $seo?->description;

        return $data;
    }

    protected function afterSave(): void
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
