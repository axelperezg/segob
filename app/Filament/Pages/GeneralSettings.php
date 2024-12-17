<?php

namespace App\Filament\Pages;

use App\Settings\AppSettings;
use App\Settings\SegobSettings;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\SettingsPage;

class GeneralSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?int $navigationSort = 7;
    protected static string $settings = AppSettings::class;

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
                    ->columns(3)
                    ->schema([
                        TextInput::make('facebook')
                            ->label('Facebook')
                            ->url()
                            ->prefix('https://')
                            ->placeholder('facebook.com/your-page'),
                        TextInput::make('twitter')
                            ->label('X (Twitter)')
                            ->url()
                            ->prefix('https://')
                            ->placeholder('twitter.com/your-handle'),
                        TextInput::make('instagram')
                            ->label('Instagram')
                            ->url()
                            ->prefix('https://')
                            ->placeholder('instagram.com/your-handle'),
                        TextInput::make('youtube')
                            ->label('Youtube')
                            ->url()
                            ->prefix('https://')
                            ->placeholder('youtube.com/your-channel'),
                        TextInput::make('tiktok')
                            ->label('TikTok')
                            ->url()
                            ->prefix('https://')
                            ->placeholder('tiktok.com/@your-handle'),
                    ]),
            ]);
    }
}
