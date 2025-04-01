<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Michaeld555\FilamentCroppie\Components\Croppie;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Banners';

    protected static ?string $breadcrumb = 'Banners';

    protected static ?int $navigationSort = 1;

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
                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('external_url')
                            ->label('URL Externa')
                            ->url()
                            ->required()
                            ->maxLength(255),
                        Croppie::make('image')
                            ->label('Imagen')
                            ->viewportType('square')
                            ->imageSize('original')
                            ->modalTitle('Recortar imagen')
                            ->viewportWidth(540)
                            ->viewportHeight(130)
                            ->modalDescription('Ajusta la imagen manteniendo proporción 16:9')
                            ->disk('public')
                            ->required()
                            ->columnSpanFull(),
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
                TextColumn::make('external_url')
                    ->label('URL Externa')
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
