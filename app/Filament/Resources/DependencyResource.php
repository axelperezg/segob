<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DependencyResource\Pages;
use App\Models\Dependency;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Forms\Get;
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

    protected static ?string $modelLabel = 'Dependencia';

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function getNavigationGroup(): string
    {
        return 'Catálogos CMS Contenido';
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
                                        TextInput::make('name')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->maxLength(255)
                                            ->label('Nombre')
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
