<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActionResource\Pages;
use App\Models\Action;
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

class ActionResource extends Resource
{
    protected static ?string $model = Action::class;

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationLabel = 'Acciones';

    protected static ?string $breadcrumb = 'Acciones';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información')
                    ->columns()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
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
                            ->unique(Action::class, 'slug', ignoreRecord: true),
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
                    ->searchable(),
                TextColumn::make('posts_count')
                    ->counts('posts')
                    ->label('Publicaciones'),
                TextColumn::make('slug')
                    ->searchable(),
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
            'index' => Pages\ListActions::route('/'),
            'create' => Pages\CreateAction::route('/create'),
            'edit' => Pages\EditAction::route('/{record}/edit'),
        ];
    }
}
