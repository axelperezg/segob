<?php

namespace App\Filament\Resources\VideoResource\Pages;

use App\Filament\Resources\VideoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Video;
use RalphJSmit\Laravel\SEO\Models\SEO;

class EditVideo extends EditRecord
{
    protected static string $resource = VideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Editar video';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $seo = SEO::where('model_id', $this->record->id)->where('model_type', Video::class)->first();
        
        $data['meta_title'] = $seo?->title;
        $data['meta_description'] = $seo?->description;

        return $data;
    }

    protected function afterSave(): void
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
