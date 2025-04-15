<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Enums\Posts\ContentTypeEnum;
use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\CreateRecord;

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
}
