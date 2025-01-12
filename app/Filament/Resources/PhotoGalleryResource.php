<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhotoGalleryResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers\PostsRelationManager;
use App\Models\PhotoGallery;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PhotoGalleryResource extends Resource
{
    protected static ?string $model = PhotoGallery::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Fotogalerías';

    protected static ?string $breadcrumb = 'Fotogalerías';

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Imagen')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('image')
                            ->image()
                            ->collection('image')
                            ->hiddenLabel(),
                    ]),
                Section::make('Información')
                    ->columns()
                    ->schema([
                        Toggle::make('is_published')
                            ->default(true)
                            ->columnSpanFull()
                            ->label('Publicado'),
                        TextInput::make('name')
                            ->placeholder('Nombre de fotogalería')
                            ->live(onBlur: true)
                            ->required()
                            ->label('Título')
                            ->afterStateUpdated(
                                fn (string $operation, $state, Set $set) => $operation === 'create'
                                    ? $set('slug', Str::slug($state))
                                    : null
                            ),
                        TextInput::make('slug')
                            ->disabled()
                            ->dehydrated()
                            ->required()
                            ->maxLength(255)
                            ->unique(PhotoGallery::class, 'slug', ignoreRecord: true),
                        DatePicker::make('published_at')
                            ->default(now())
                            ->label('Fecha'),
                    ]),
                Section::make('Galería')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->multiple()
                            ->collection('gallery')
                            ->hiddenLabel(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Título'),
                IconColumn::make('is_published')
                    ->label('Publicado')
                    ->boolean(),
                TextColumn::make('published_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y'),
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Imagen')
                    ->collection('image'),
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
            PostsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPhotoGalleries::route('/'),
            'create' => Pages\CreatePhotoGallery::route('/create'),
            'edit' => Pages\EditPhotoGallery::route('/{record}/edit'),
        ];
    }
}
