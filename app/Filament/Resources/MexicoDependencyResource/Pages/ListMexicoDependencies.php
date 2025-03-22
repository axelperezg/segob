<?php

namespace App\Filament\Resources\MexicoDependencyResource\Pages;

use App\Filament\Resources\MexicoDependencyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMexicoDependencies extends ListRecords
{
    protected static string $resource = MexicoDependencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nueva dependencia')
                ->icon('heroicon-o-plus'),
        ];
    }

    public function getTitle(): string
    {
        return 'Dependencias México';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
} 