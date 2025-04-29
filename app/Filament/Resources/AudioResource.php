<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AudioResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers\PostsRelationManager;
use App\Models\Audio;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Get;
use Filament\Forms\Set;

class AudioResource extends Resource
{
    protected static ?string $model = Audio::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Versión';

    protected static ?string $pluralModelLabel = 'Versiones';

    protected static ?string $navigationIcon = 'heroicon-o-speaker-wave';

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
                                            ->required()
                                            ->label('Título')
                                            ->suffixAction(
                                                Action::make('copyToMetaTitle')
                                                    ->label('Copiar a Meta Título')
                                                    ->icon('heroicon-m-clipboard')
                                                    ->action(function (Get $get, Set $set) {
                                                        $set('meta_title', $get('title'));
                                                    })
                                            ),
                                        DatePicker::make('published_at')
                                            ->default(now())
                                            ->label('Fecha'),
                                        SpatieMediaLibraryFileUpload::make('audio')
                                            ->label('Audio')
                                            ->collection('audio')
                                            ->maxSize(15120)
                                            ->acceptedFileTypes(['audio/mpeg', 'audio/wav', 'audio/ogg', 'audio/mp3'])
                                            ->required(),
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
                    ->searchable(),
                IconColumn::make('is_published')
                    ->label('Publicado')
                    ->boolean(),
                TextColumn::make('published_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y'),
                TextColumn::make('posts_count')
                    ->label('Posts')
                    ->counts('posts'),
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
            'index' => Pages\ListAudio::route('/'),
            'create' => Pages\CreateAudio::route('/create'),
            'edit' => Pages\EditAudio::route('/{record}/edit'),
        ];
    }
}
