<?php

namespace App\Filament\Pages;

use App\Settings\AppSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class GeneralSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?int $navigationSort = 1;

    protected static ?string $title = 'Configuración del Sitio';

    protected static string $settings = AppSettings::class;

    protected static ?string $navigationLabel = 'Configuración';

    public static function getNavigationGroup(): ?string
    {
        return 'Configuración del Sitio';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Top Bar')
                    ->collapsible()
                    ->collapsed()
                    ->heading('Enlaces de Top Bar')
                    ->description('Configure los enlaces que aparecen en la barra superior (Noticias, Gobierno, etc.)')
                    ->schema([
                        Repeater::make('top_bar_links')
                            ->hiddenLabel()
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nombre')
                                    ->required()
                                    ->placeholder('Ej: Noticias, Gobierno'),
                                TextInput::make('url')
                                    ->label('URL')
                                    ->required()
                                    ->url()
                                    ->placeholder('https://ejemplo.com'),
                                Select::make('external')
                                    ->label('Abrir en')
                                    ->options([
                                        false => 'Misma pestaña',
                                        true => 'Nueva pestaña',
                                    ])
                                    ->default(false)
                                    ->required(),
                            ])
                            ->columns(3)
                            ->columnSpanFull()
                            ->defaultItems(0)
                            ->reorderable(),
                    ]),
                Section::make('Logo')
                    ->collapsible()
                    ->collapsed()
                    ->columns(2)
                    ->schema([
                        Fileupload::make('logo')
                            ->label('Logo')
                            ->hiddenLabel()
                            ->image(),
                        Fileupload::make('mexico_logo')
                            ->label('Logo Gobierno de México')
                            ->image(),
                    ]),
                Section::make('social')
                ->collapsible()
                ->collapsed()
                    ->heading('Redes Sociales')
                    ->schema([
                        Repeater::make('social_networks')
                            ->hiddenLabel()
                            ->maxItems(5)
                            ->schema([
                                Select::make('network')
                                    ->options([
                                        'facebook' => 'Facebook',
                                        'twitter' => 'X (Twitter)',
                                        'instagram' => 'Instagram',
                                        'youtube' => 'Youtube',
                                        'tiktok' => 'TikTok',
                                    ])
                                    ->unique()
                                    ->required(),
                                TextInput::make('url')
                                    ->label('URL')
                                    ->url()
                                    ->required(),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),
                Section::make('contact')
                ->collapsible()
                    ->collapsed()
                    ->heading('Contacto')
                    ->schema([
                        TextInput::make('map_url')
                            ->label('URL del Mapa')
                            ->columnSpanFull()
                            ->dehydrateStateUsing(function ($state) {
                                if (! $state) {
                                    return null;
                                }

                                return preg_replace('/width="[0-9]+"/', 'width="100%"', $state);
                            }),
                        RichEditor::make('contact_content')
                            ->label('Contenido')
                            ->toolbarButtons(['bold'])
                            ->columnSpanFull(),
                    ]),
                Section::make('footer')
                ->collapsible()
                    ->collapsed()
                    ->heading('Footer')
                    ->schema([
                        Repeater::make('footer_links')
                            ->hiddenLabel()
                            ->columns(12)
                            ->collapsible()
                            ->schema([
                                TextInput::make('title')
                                    ->columnSpan(3)
                                    ->label('Título')
                                    ->required(),
                                Repeater::make('links')
                                    ->columnSpan(9)
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('Título')
                                            ->required(),
                                        TextInput::make('url')
                                            ->label('URL')
                                            ->required(),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
