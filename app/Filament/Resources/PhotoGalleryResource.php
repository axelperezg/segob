<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhotoGalleryResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers\PostsRelationManager;
use App\Models\PhotoGallery;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Michaeld555\FilamentCroppie\Components\Croppie;

class PhotoGalleryResource extends Resource
{
    protected static ?string $model = PhotoGallery::class;

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Fotogalerías';

    protected static ?string $breadcrumb = 'Fotogalerías';

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function getNavigationGroup(): string
    {
        return 'CMS Contenido | Noticias';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Contenido')
                            ->schema([
                                Section::make('Imagen')
                                    ->schema([
                                        Croppie::make('image')
                                            ->hiddenLabel()
                                            ->viewportType('square')
                                            ->imageSize('original')
                                            ->modalTitle('Recortar imagen')
                                            ->viewportWidth(250)
                                            ->viewportHeight(140.625)
                                            ->modalDescription('Ajusta la imagen manteniendo proporción 16:9')
                                            ->disk('public'),
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
                                                function (string $operation, $state, Set $set) {
                                                    if ($operation === 'create') {
                                                        $set('slug', Str::slug($state));
                                                    }
                                                }
                                            )
                                            ->suffixAction(
                                                \Filament\Forms\Components\Actions\Action::make('copyToMetaTitle')
                                                    ->label('Copiar a Meta Título')
                                                    ->icon('heroicon-m-clipboard')
                                                    ->action(function (Get $get, Set $set) {
                                                        $set('meta_title', $get('name'));
                                                    })
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
                            ]),
                        Tab::make('SEO')
                            ->schema([
                                Section::make('SEO')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('meta_title')
                                            ->label('Título SEO')
                                            ->maxLength(60)
                                            ->live(onBlur: true)
                                            ->helperText(fn (?string $state): string => strlen($state ?? '') . '/60 caracteres'),
                                        Textarea::make('meta_description')
                                            ->label('Descripción SEO')
                                            ->maxLength(160)
                                            ->live(onBlur: true)
                                            ->helperText(fn (?string $state): string => strlen($state ?? '') . '/160 caracteres'),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
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
