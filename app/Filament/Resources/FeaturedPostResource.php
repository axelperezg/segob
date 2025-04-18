<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeaturedPostResource\Pages;
use App\Models\FeaturedPost;
use App\Models\Post;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FeaturedPostResource extends Resource
{
    protected static ?string $model = FeaturedPost::class;

    protected static ?string $navigationLabel = 'Configurar Inicio';

    protected static ?string $breadcrumb = 'Noticias';

    protected static ?string $navigationGroup = 'Configuración del Sitio';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('featured_posts')
                    ->defaultItems(6)
                    ->columnSpanFull()
                    ->simple(
                        Select::make('post_id')
                            ->label('Noticia')
                            ->required()
                            ->searchable()
                            ->options(Post::all()->pluck('title', 'id'))
                    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort')
                    ->label('Orden'),
                TextColumn::make('post.title')
                    ->label('Noticia')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeaturedPosts::route('/'),
            'edit-all' => Pages\EditAllFeaturedPosts::route('/edit-all'),
        ];
    }
}
