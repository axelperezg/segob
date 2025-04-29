<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Enums\Posts\ContentTypeEnum;
use App\Filament\Resources\PostResource;
use App\Models\Post;
use Filament\Resources\Pages\CreateRecord;
use RalphJSmit\Laravel\SEO\Models\SEO;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    public function getTitle(): string
    {
        return 'Crear post';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
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

    protected function afterCreate(): void
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
