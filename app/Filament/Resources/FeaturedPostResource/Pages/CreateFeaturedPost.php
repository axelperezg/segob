<?php

namespace App\Filament\Resources\FeaturedPostResource\Pages;

use App\Filament\Resources\FeaturedPostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateFeaturedPost extends CreateRecord
{
    protected static string $resource = FeaturedPostResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $postIds = $data['featured_posts'];

        foreach ($postIds as $index => $postId) {
            $lastFeaturedPost = static::getModel()::create([
                'post_id' => $postId,
                'sort' => $index + 1
            ]);
        }

        return $lastFeaturedPost;
    }

    public function getTitle(): string
    {
        return 'Crear destacado';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
