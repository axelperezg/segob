<?php

namespace App\Filament\Resources\DocumentSectionResource\Pages;

use App\Filament\Resources\DocumentSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDocumentSection extends EditRecord
{
    protected static string $resource = DocumentSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
