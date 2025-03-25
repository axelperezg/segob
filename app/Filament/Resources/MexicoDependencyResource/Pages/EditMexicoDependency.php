<?php

namespace App\Filament\Resources\MexicoDependencyResource\Pages;

use App\Filament\Resources\MexicoDependencyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMexicoDependency extends EditRecord
{
    protected static string $resource = MexicoDependencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Editar dependencia';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
