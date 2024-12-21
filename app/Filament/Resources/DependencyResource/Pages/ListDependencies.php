<?php

namespace App\Filament\Resources\DependencyResource\Pages;

use App\Filament\Resources\DependencyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDependencies extends ListRecords
{
    protected static string $resource = DependencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
