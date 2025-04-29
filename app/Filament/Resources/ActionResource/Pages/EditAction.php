<?php

namespace App\Filament\Resources\ActionResource\Pages;

use App\Filament\Resources\ActionResource;
use App\Models\Action;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use RalphJSmit\Laravel\SEO\Models\SEO;

class EditAction extends EditRecord
{
    protected static string $resource = ActionResource::class;

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
        $seo = SEO::where('model_id', $this->record->id)->where('model_type', Action::class)->first();
        
        $data['meta_title'] = $seo?->title;
        $data['meta_description'] = $seo?->description;

        return $data;
    }

    protected function afterSave(): void
    {
        SEO::updateOrCreate([
            'model_id' => $this->record->id,
            'model_type' => Action::class,
        ], [
            'title' => $this->data['meta_title'],
            'description' => $this->data['meta_description'],
        ]);
    }
}
