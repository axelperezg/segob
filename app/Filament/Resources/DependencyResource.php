<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DependencyResource\Pages;
use App\Models\Dependency;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Michaeld555\FilamentCroppie\Components\Croppie;

class DependencyResource extends Resource
{
    protected static ?string $model = Dependency::class;

    protected static ?string $navigationLabel = 'Dependencias';

    protected static ?int $navigationSort = 3;

    protected static ?string $breadcrumb = 'Dependencias';

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function getNavigationGroup(): string
    {
        return 'Catálogos CMS Contenido';
    }

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
                    ]),
                Section::make('Imagen')
                    ->schema([
                        Croppie::make('image')
                            ->label('Imagen')
                            ->hiddenLabel()
                            ->viewportType('square')
                            ->imageSize('original')
                            ->modalTitle('Recortar imagen')
                            ->viewportWidth(250)
                            ->viewportHeight(140.625)
                            ->modalDescription('Ajusta la imagen manteniendo proporción 16:9')
                            ->disk('public'),
                    ]),
                Section::make('Banner')
                    ->schema([
                        Croppie::make('banner')
                            ->label('Banner')
                            ->hiddenLabel()
                            ->viewportType('square')
                            ->imageSize('original')
                            ->modalTitle('Recortar banner')
                            ->viewportWidth(540)
                            ->viewportHeight(130)
                            ->modalDescription('Ajusta la imagen manteniendo proporción 16:9')
                            ->disk('public'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                TextColumn::make('posts_count')
                    ->counts('posts')
                    ->label('Publicaciones'),
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
