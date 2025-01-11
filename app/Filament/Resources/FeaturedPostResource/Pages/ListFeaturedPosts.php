<?php

namespace App\Filament\Resources\FeaturedPostResource\Pages;

use App\Filament\Resources\FeaturedPostResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFeaturedPosts extends ListRecords
{
    protected static string $resource = FeaturedPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nuevo destacado')
                ->icon('heroicon-o-plus'),
            Action::make('editFeaturedPosts')
                ->label('Editar posts destacados')
                ->url(route('filament.admin.resources.featured-posts.edit-all'))
                ->button(),
        ];
    }

    public function getTitle(): string
    {
        return 'Destacados';
    }
}
