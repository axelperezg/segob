<?php

namespace App\Filament\Resources\SegobPostResource\Pages;

use App\Filament\Resources\SegobPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSegobPosts extends ListRecords
{
    protected static string $resource = SegobPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nuevo contenido')
                ->icon('heroicon-o-plus'),
        ];
    }

    public function getTitle(): string
    {
        return 'Contenido Segob';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
} 