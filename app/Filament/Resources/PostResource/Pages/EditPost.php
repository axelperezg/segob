<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Enums\Posts\ContentTypeEnum;
use App\Filament\Resources\PostResource;
use App\Models\Post;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use RalphJSmit\Laravel\SEO\Models\SEO;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Editar post';
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['content_type'] != ContentTypeEnum::BULLETIN->value) {
            $data['bulletin'] = null;
            $data['year'] = null;
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $seo = SEO::where('model_id', $this->record->id)->where('model_type', Post::class)->first();
        
        $data['meta_title'] = $seo?->title;
        $data['meta_description'] = $seo?->description;

        return $data;
    }

    protected function afterSave(): void
    {
        SEO::updateOrCreate([
            'model_id' => $this->record->id,
            'model_type' => Post::class,
        ], [
            'title' => $this->data['meta_title'],
            'description' => $this->data['meta_description'],
        ]);
    }
    
}
