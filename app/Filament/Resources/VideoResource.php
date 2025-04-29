<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoResource\Pages;
use App\Models\Video;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Michaeld555\FilamentCroppie\Components\Croppie;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationLabel = 'Videos';

    protected static ?string $breadcrumb = 'Videos';

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

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
                                Section::make('Información')
                                    ->columns()
                                    ->schema([
                                        Toggle::make('is_published')
                                            ->label('Publicado')
                                            ->columnSpanFull()
                                            ->default(true),
                                        TextInput::make('title')
                                            ->live(onBlur: true)
                                            ->required()
                                            ->label('Título')
                                            ->afterStateUpdated(
                                                function (string $operation, $state, Set $set) {
                                                    if ($operation === 'create') {
                                                        $set('slug', Str::slug($state));
                                                        $set('meta_title', $state);
                                                    }
                                                }
                                            ),
                                        TextInput::make('slug')
                                            ->disabled()
                                            ->dehydrated()
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(Video::class, 'slug', ignoreRecord: true),
                                        DatePicker::make('published_at')
                                            ->default(now())
                                            ->label('Fecha'),
                                        TextInput::make('url')
                                            ->columnSpanFull()
                                            ->required()
                                            ->label('URL'),
                                    ]),
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
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}
