<?php

namespace App\Filament\Resources;

use App\Enums\Posts\ContentTypeEnum;
use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Michaeld555\FilamentCroppie\Components\Croppie;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationLabel = 'Contenido';

    protected static ?int $navigationSort = 1;

    protected static ?string $breadcrumb = 'Contenido';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Toggle::make('is_published')
                            ->default(true)
                            ->label('Publicado')
                            ->columnSpanFull(),
                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->maxLength(255)
                            ->label('Título')
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
                            ->unique(Post::class, 'slug', ignoreRecord: true),
                        RichEditor::make('content')
                            ->required()
                            ->columnSpanFull(),
                        RichEditor::make('excerpt')
                            ->label('Resumen')
                            ->required()
                            ->columnSpanFull(),
                        Select::make('content_type')
                            ->live()
                            ->required()
                            ->options(ContentTypeEnum::class)
                            ->label('Tipo de contenido'),
                        TextInput::make('keywords')
                            ->label('Palabras clave'),
                        TextInput::make('bulletin')
                            ->hidden(fn (Get $get) => $get('content_type') != ContentTypeEnum::BULLETIN->value)
                            ->label('Boletín'),
                        TextInput::make('year')
                            ->hidden(fn (Get $get) => $get('content_type') != ContentTypeEnum::BULLETIN->value)
                            ->label('Año'),
                        Select::make('states')
                            ->multiple()
                            ->relationship('states', 'name')
                            ->preload()
                            ->searchable()
                            ->label('Estados'),
                        DatePicker::make('published_at')
                            ->required()
                            ->default(now())
                            ->label('Fecha de publicación'),
                        Select::make('created_by')
                            ->relationship('createdBy', 'name')
                            ->searchable()
                            ->required()
                            ->default(auth()->id())
                            ->options(User::all()->pluck('name', 'id'))
                            ->label('Autor')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Nombre'),
                                TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Correo'),
                                TextInput::make('password')
                                    ->password()
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Contraseña'),
                            ]),
                    ])
                    ->columns(2),
                Section::make()
                    ->schema([
                        Select::make('actions')
                            ->relationship('actions', 'name')
                            ->multiple()
                            ->label('Acciones')
                            ->preload()
                            ->columnSpan(1),
                        Select::make('dependencies')
                            ->relationship('dependencies', 'name')
                            ->multiple()
                            ->preload()
                            ->label('Dependencias')
                            ->columnSpan(1),
                    ])
                    ->columns(2),
                Grid::make([
                    'sm' => 2,
                ])
                    ->schema([
                        Section::make('Imagen')
                            ->schema([
                                Croppie::make('image')
                                    ->viewportType('square')
                                    ->viewportHeight(250)
                                    ->viewportWidth(400)
                                    ->modalTitle('Recortar imagen')
                                    ->modalDescription('Ajusta la imagen al tamaño deseado')
                                    ->disk('public'),
                            ])
                            ->collapsible()
                            ->columnSpan(1),
                        Section::make('Documento')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('documents')
                                    ->collection('documents')
                                    ->hiddenLabel(),
                            ])
                            ->collapsible()
                            ->columnSpan(1),
                    ]),
                Section::make()
                    ->heading(function (Get $get) {
                        return $get('audio_id')
                            ? 'Audio Relacionado'
                            : 'Relacionar Audio';
                    })
                    ->schema([
                        Select::make('audio_id')
                            ->searchable()
                            ->hiddenLabel()
                            ->relationship('audio', 'title'),
                    ]),
                Section::make('Documento')
                    ->heading(function (Get $get) {
                        return $get('document_id')
                            ? 'Documento Relacionado'
                            : 'Relacionar Documento';
                    })
                    ->schema([
                        Select::make('document_id')
                            ->searchable()
                            ->hiddenLabel()
                            ->relationship('document', 'name'),
                    ]),
                Section::make('Galería')
                    ->heading(function (Get $get) {
                        return $get('photo_gallery_id')
                            ? 'Galería Relacionada'
                            : 'Relacionar Galería';
                    })
                    ->schema([
                        Select::make('photo_gallery_id')
                            ->searchable()
                            ->hiddenLabel()
                            ->relationship('photoGallery', 'name'),
                    ]),
                Section::make('Video')
                    ->heading(function (Get $get) {
                        return $get('video_id')
                            ? 'Video Relacionado'
                            : 'Relacionar Video';
                    })
                    ->schema([
                        Select::make('video_id')
                            ->searchable()
                            ->hiddenLabel()
                            ->relationship('video', 'title'),
                    ]),
                Section::make('Versión Estenográfica')
                    ->hidden(fn (Get $get) => $get('content_type') == ContentTypeEnum::STENOGRAPHIC_VERSION->value)
                    ->heading(function (Get $get) {
                        return $get('stenographic_version_id')
                            ? 'Versión Estenográfica Relacionada'
                            : 'Relacionar Versión Estenográfica';
                    })
                    ->schema([
                        Select::make('stenographic_version_id')
                            ->searchable()
                            ->hiddenLabel()
                            ->options(
                                Post::query()
                                    ->where('content_type', ContentTypeEnum::STENOGRAPHIC_VERSION)
                                    ->pluck('title', 'id')
                            ),
                    ]),
                Section::make('Información de edición')
                    ->columns()
                    ->schema([
                        Placeholder::make('created_info')
                            ->content(fn (Post $record): string => "Creado por {$record->createdBy->name} el {$record->created_at->format('d/m/Y H:i:s')}")
                            ->hiddenLabel(),
                        Placeholder::make('last_edited_info')
                            ->content(fn (Post $record): string => $record->last_edited_by ? "Última edición por {$record->lastEditedBy->name} el {$record->last_edited_at->format('d/m/Y H:i:s')}" : null)
                            ->hiddenLabel()
                            ->visible(fn (Post $record): bool => $record->last_edited_by !== null),
                    ])
                    ->hidden(fn (?Post $record) => $record === null)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->wrap()
                    ->searchable()
                    ->label('Título'),
                TextColumn::make('createdBy.name')
                    ->label('Usuario'),
                TextColumn::make('published_at')
                    ->label('Fecha de publicación')
                    ->dateTime('d/m/Y'),
                TextColumn::make('created_at')
                    ->label('Fecha de creación')
                    ->dateTime('d/m/Y'),
                IconColumn::make('is_published')
                    ->label('Publicado')
                    ->boolean(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
