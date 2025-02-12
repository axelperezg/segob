<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DependencyResource\Pages;
use App\Models\Dependency;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Get;
use Filament\Forms\Set;

class DependencyResource extends Resource
{
    protected static ?string $model = Dependency::class;

    protected static ?string $navigationLabel = 'Dependencias';

    protected static ?int $navigationSort = 6;

    protected static ?string $breadcrumb = 'Dependencias';

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información')
                    ->columns()
                    ->schema([
                            
                            TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->maxLength(255)
                            ->label('Nombre')
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
                            ->unique(Dependency::class, 'slug', ignoreRecord: true),
                        SpatieMediaLibraryFileUpload::make('image')
                            ->collection('image')
                            ->required()
                            ->image(),
                        SpatieMediaLibraryFileUpload::make('banner')
                            ->collection('banner')
                            ->required()
                            ->image(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('posts_count')
                    ->counts('posts')
                    ->label('Publicaciones'),
                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('image')
                    ->label('Imagen'),
                SpatieMediaLibraryImageColumn::make('banner')
                    ->collection('banner')
                    ->label('Banner'),
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
            'index' => Pages\ListDependencies::route('/'),
            'create' => Pages\CreateDependency::route('/create'),
            'edit' => Pages\EditDependency::route('/{record}/edit'),
        ];
    }
}
