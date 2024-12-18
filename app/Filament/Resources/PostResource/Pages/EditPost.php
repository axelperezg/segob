<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Enums\Posts\ContentTypeEnum;
use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

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
}
