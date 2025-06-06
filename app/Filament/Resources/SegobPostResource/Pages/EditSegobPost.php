<?php

namespace App\Filament\Resources\SegobPostResource\Pages;

use App\Filament\Resources\SegobPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSegobPost extends EditRecord
{
    protected static string $resource = SegobPostResource::class;

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
