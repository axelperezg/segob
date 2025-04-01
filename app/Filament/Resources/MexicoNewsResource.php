<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MexicoNewsResource\Pages;
use App\Models\MexicoNews;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Michaeld555\FilamentCroppie\Components\Croppie;

class MexicoNewsResource extends Resource
{
    protected static ?string $model = MexicoNews::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Noticias México';

    protected static ?string $breadcrumb = 'Noticias México';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function getNavigationGroup(): string
    {
        return 'Noticias MX';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información')
                    ->columns()
                    ->schema([
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
                        Select::make('mexico_dependency_id')
                            ->relationship('mexicoDependency', 'name')
                            ->searchable()
                            ->preload()
                            ->label('Dependencia'),
                    ]),
                Grid::make([
                    'sm' => 2,
                ])
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
                            ])
                            ->collapsible()
                            ->columnSpan(1),
                        Section::make('Documento PDF')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('document')
                                    ->collection('document')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->hiddenLabel(),
                            ])
                            ->collapsible()
                            ->columnSpan(1),
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
                TextColumn::make('mexicoDependency.name')
                    ->label('Dependencia')
                    ->searchable(),
                TextColumn::make('published_at')
                    ->label('Fecha de publicación')
                    ->dateTime('d/m/Y H:i')
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
