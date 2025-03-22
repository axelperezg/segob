<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MexicoNewsResource\Pages;
use App\Models\MexicoNews;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Michaeld555\FilamentCroppie\Components\Croppie;

class MexicoNewsResource extends Resource
{
    protected static ?string $model = MexicoNews::class;

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationLabel = 'Noticias México';

    protected static ?string $breadcrumb = 'Noticias México';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información')
                    ->columns()
                    ->schema([
                        Toggle::make('is_published')
                            ->label('Publicado')
                            ->default(true)
                            ->columnSpanFull(),
                        TextInput::make('title')
                            ->required()
                            ->label('Título')
                            ->maxLength(255),
                        DateTimePicker::make('published_at')
                            ->required()
                            ->default(now())
                            ->label('Fecha de publicación'),
                        TextInput::make('url')
                            ->required()
                            ->label('Enlace')
                            ->url()
                            ->columnSpanFull(),
                        Select::make('dependency_id')
                            ->relationship('dependency', 'name')
                            ->searchable()
                            ->preload()
                            ->label('Dependencia'),
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
                TextColumn::make('dependency.name')
                    ->label('Dependencia')
                    ->searchable(),
                IconColumn::make('is_published')
                    ->label('Publicado')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('published_at')
                    ->label('Fecha de publicación')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Fecha de creación')
                    ->dateTime('d/m/Y')
                    ->sortable(),
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
            'index' => Pages\ListMexicoNews::route('/'),
            'create' => Pages\CreateMexicoNews::route('/create'),
            'edit' => Pages\EditMexicoNews::route('/{record}/edit'),
        ];
    }
} 