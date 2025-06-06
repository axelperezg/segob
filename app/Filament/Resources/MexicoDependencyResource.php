<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MexicoDependencyResource\Pages;
use App\Models\MexicoDependency;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MexicoDependencyResource extends Resource
{
    protected static ?string $model = MexicoDependency::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Dependencias México';

    protected static ?string $breadcrumb = 'Dependencias México';

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function getNavigationGroup(): string
    {
        return 'Noticias MX';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Nombre'),
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Imagen')
                            ->collection('image')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg']),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Fecha de creación')
                    ->dateTime('d/m/Y')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Última actualización')
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
            'index' => Pages\ListMexicoDependencies::route('/'),
            'create' => Pages\CreateMexicoDependency::route('/create'),
            'edit' => Pages\EditMexicoDependency::route('/{record}/edit'),
        ];
    }
}
