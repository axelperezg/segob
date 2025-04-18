<?php

namespace App\Filament\Resources;

use App\Enums\Documents\DocumentTypeEnum;
use App\Filament\Resources\DocumentResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers\PostsRelationManager;
use App\Models\Document;
use App\Models\DocumentSection;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Michaeld555\FilamentCroppie\Components\Croppie;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Documentos';

    protected static ?string $breadcrumb = 'Documentos';

    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function getNavigationGroup(): string
    {
        return 'CMS Contenido | Noticias';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns()
                    ->schema([
                        Toggle::make('is_published')
                            ->default(true)
                            ->label('Publicado')
                            ->columnSpanFull(),
                        TextInput::make('name')
                            ->required()
                            ->label('Nombre')
                            ->live(onBlur: true)
                            ->afterStateUpdated(
                                fn (string $operation, $state, Set $set) => $set('slug', Str::slug($state))
                            ),
                        TextInput::make('slug')
                            ->disabled()
                            ->dehydrated()
                            ->required()
                            ->label('Slug')
                            ->unique(Document::class, 'slug', ignoreRecord: true),
                        DatePicker::make('published_at')
                            ->label('Fecha')
                            ->default(now()),
                        Select::make('type')
                            ->label('Tipo')
                            ->options(DocumentTypeEnum::class),
                        Select::make('document_section_id')
                            ->label('Sección')
                            ->options(DocumentSection::all()->pluck('name', 'id'))
                            ->searchable()
                            ->preload(),
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
                SpatieMediaLibraryFileUpload::make('document')
                    ->label('Documento')
                    ->collection('document')
                    ->maxSize(5120)
                    ->acceptedFileTypes(['application/pdf'])
                    ->required(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PostsRelationManager::class,
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn (DocumentTypeEnum $state) => $state->getLabel()),
                TextColumn::make('documentSection.name')
                    ->label('Sección')
                    ->sortable(),
                TextColumn::make('published_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y'),
                IconColumn::make('is_published')
                    ->label('Publicado')
                    ->boolean(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
