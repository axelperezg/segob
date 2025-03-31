<?php

namespace App\Filament\Resources\SegobPostResource\Pages;

use App\Filament\Resources\SegobPostResource;
use App\Models\Dependency;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

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