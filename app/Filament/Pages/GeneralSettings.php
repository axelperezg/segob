<?php

namespace App\Filament\Pages;

use App\Settings\AppSettings;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class GeneralSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?int $navigationSort = 7;

    protected static string $settings = AppSettings::class;

    protected static ?string $navigationLabel = 'Configuración General';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Logo')
                    ->schema([
                        Fileupload::make('logo')
                            ->label('Logo')
                            ->hiddenLabel()
                            ->image()
                            ->columnSpanFull(),
                    ]),
                Section::make('social')
                    ->heading('Redes Sociales')
                    ->schema([
                        Repeater::make('social_networks')
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
            ]);
    }
}
