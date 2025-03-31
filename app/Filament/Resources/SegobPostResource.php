<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SegobPostResource\Pages;
use App\Models\Dependency;
use App\Models\Post;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SegobPostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationLabel = 'Segob';

    protected static ?int $navigationSort = 2;

    protected static ?string $breadcrumb = 'Segob';

    protected static ?string $slug = 'segob-posts';

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function getNavigationGroup(): string
    {
        return 'CMS Contenido | Noticias';
    }

    public static function form(Form $form): Form
    {
        return PostResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(
                fn (Builder $query) => $query
                    ->whereHas('dependencies', fn ($query) => $query->where('name', 'segob'))
                )
            ->columns([
                TextColumn::make('title')
                    ->wrap()
                    ->searchable()
                    ->label('Título'),
                TextColumn::make('createdBy.name')
                    ->label('Usuario'),
                TextColumn::make('published_at')
                    ->label('Fecha de publicación')
                    ->dateTime('d/m/Y'),
                TextColumn::make('created_at')
                    ->label('Fecha de creación')
                    ->dateTime('d/m/Y'),
                IconColumn::make('is_published')
                    ->label('Publicado')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSegobPosts::route('/'),
            'create' => Pages\CreateSegobPost::route('/create'),
            'edit' => Pages\EditSegobPost::route('/{record}/edit'),
        ];
    }
} 