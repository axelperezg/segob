<?php

namespace App\Filament\Resources\SegobPostResource\Pages;

use App\Filament\Resources\SegobPostResource;
use App\Models\Dependency;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateSegobPost extends CreateRecord
{
    protected static string $resource = SegobPostResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        parent::afterCreate();

        // Attach the "segob" dependency to the newly created post
        $segobDependency = Dependency::where('name', 'segob')->first();
        
        if ($segobDependency && $this->record) {
            $this->record->dependencies()->attach($segobDependency->id);
        }
    }
} 