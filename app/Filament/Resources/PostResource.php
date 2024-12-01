<?php

namespace App\Filament\Resources;

use App\Enums\MexicanStateEnum;
use App\Enums\Posts\ContentTypeEnum;
use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
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

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationLabel = 'Contenido';

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
                        Select::make('content_type')
                            ->nullable()
                            ->options(ContentTypeEnum::class)
                            ->label('Tipo de contenido'),
                        TextInput::make('keywords')
                            ->label('Palabras clave'),
                        Select::make('state')
                            ->nullable()
                            ->searchable()
                            ->options(MexicanStateEnum::class)
                            ->label('Estado'),
                        DatePicker::make('published_at')
                            ->required()
                            ->default(now())
                            ->label('Fecha de publicación'),
                        Select::make('created_by')
                            ->relationship('createdBy', 'name')
                            ->required()
                            ->default(auth()->id())
                            ->options(User::all()->pluck('name', 'id'))
                            ->label('Autor'),
                    ])
                    ->columns(2),
                Section::make()
                    ->schema([
                        Select::make('actions')
                            ->relationship('actions', 'name')
                            ->multiple()
                            ->label('Acciones')
                            ->columnSpan(1),
                        Select::make('dependencies')
                            ->relationship('dependencies', 'name')
                            ->multiple()
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
                                SpatieMediaLibraryFileUpload::make('image')
                                    ->image()
                                    ->collection('image')
                                    ->hiddenLabel(),
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
                    ->label('Autor'),
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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
