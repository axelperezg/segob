<?php

namespace App\Filament\Resources\MexicoNewsResource\Pages;

use App\Filament\Resources\MexicoNewsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMexicoNews extends ListRecords
{
    protected static string $resource = MexicoNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nueva noticia')
                ->icon('heroicon-o-plus'),
        ];
    }

    public function getTitle(): string
    {
        return 'Noticias México';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
} 