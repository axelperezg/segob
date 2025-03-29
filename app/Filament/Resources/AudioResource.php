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
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AudioResource extends Resource
{
    protected static ?string $model = Audio::class;
    protected static ?int $navigationSort = 5;
    protected static ?string $modelLabel = 'Versión';
    protected static ?string $pluralModelLabel = 'Versiones';
    protected static ?string $navigationIcon = 'heroicon-o-speaker-wave';

    public static function form(Form $form): Form
    {
        return $form
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
                            ->label('Título'),
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
