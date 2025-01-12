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

    protected static ?int $navigationSort = 8;

    protected static ?string $title = 'Configuración del Sitio';

    protected static string $settings = AppSettings::class;

    protected static ?string $navigationLabel = 'Configuración del Sitio';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Logo')
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
                    ->heading('Redes Sociales')
                    ->schema([
                        Repeater::make('social_networks')
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
            ]);
    }
}
