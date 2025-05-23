<?php

namespace App\Filament\Resources;

use App\Enums\Posts\ContentTypeEnum;
use App\Filament\Resources\PostResource\Pages;
use App\Models\Dependency;
use App\Models\Post;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
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

    public static function getNavigationGroup(): string
    {
        return 'CMS Contenido | Noticias';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Contenido')
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
                                                        $set('meta_title', $get('title'));
                                                    })
                                            ),
                                        TextInput::make('slug')
                                            ->disabled()
                                            ->dehydrated()
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(Post::class, 'slug', ignoreRecord: true),
                                        RichEditor::make('content')
                                            ->label('Contenido')
                                            ->required()
                                            ->columnSpanFull(),
                                        RichEditor::make('excerpt')
                                            ->label('Resumen')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->columnSpanFull(),
                                        \Filament\Forms\Components\Actions::make([
                                            \Filament\Forms\Components\Actions\Action::make('copyToMetaDescription')
                                                ->label('Copiar resumen a Meta Descripción')
                                                ->icon('heroicon-m-clipboard')
                                                ->action(function (Get $get, Set $set) {
                                                    $plainText = strip_tags($get('excerpt'));
                                                    $set('meta_description', $plainText);
                                                })
                                        ])
                                        ->columnSpanFull(),
                                        Select::make('content_type')
                                            ->live()
                                            ->required()
                                            ->options(ContentTypeEnum::class)
                                            ->label('Tipo de contenido'),
                                        TextInput::make('bulletin')
                                            ->hidden(fn (Get $get) => $get('content_type') != ContentTypeEnum::COMMUNIQUE->value)
                                            ->label('Número de comunicado'),
                                        TextInput::make('year')
                                            ->hidden(fn (Get $get) => $get('content_type') != ContentTypeEnum::COMMUNIQUE->value)
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
                                            ->label('Usuario que registra')
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
                                            ->default(function () {
                                                $isSegobPage = str_contains(request()->url(), '/admin/segob-posts/');
                                                $segobDependency = Dependency::where('name', 'segob')->first();

                                                if ($isSegobPage && $segobDependency) {
                                                    return [$segobDependency->id];
                                                }

                                                return [];
                                            })
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
                                                    ->hiddenLabel()
                                                    ->viewportType('square')
                                                    ->imageSize('original')
                                                    ->modalTitle('Recortar imagen')
                                                    ->viewportWidth(250)
                                                    ->viewportHeight(140.625)
                                                    ->maxSize(5120)
                                                    ->modalDescription('Ajusta la imagen manteniendo proporción 16:9')
                                                    ->disk('public'),
                                            ])
                                            ->collapsible()
                                            ->columnSpan(1),
                                        Section::make('Documento')
                                            ->schema([
                                                SpatieMediaLibraryFileUpload::make('documents')
                                                    ->collection('documents')
                                                    ->maxSize(5120)
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
