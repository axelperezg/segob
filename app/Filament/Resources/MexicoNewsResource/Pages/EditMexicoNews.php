<?php

namespace App\Filament\Resources\MexicoNewsResource\Pages;

use App\Filament\Resources\MexicoNewsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMexicoNews extends EditRecord
{
    protected static string $resource = MexicoNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Editar noticia';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
