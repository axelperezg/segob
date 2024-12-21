<?php

namespace App\Filament\Resources\DependencyResource\Pages;

use App\Filament\Resources\DependencyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

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
}
