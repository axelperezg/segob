<?php

use Illuminate\Support\Facades\Storage;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $logo = asset('assets/segob-noticias.png');
        Storage::disk('public')->put('logo.png', file_get_contents($logo));

        $this->migrator->add('general.logo', 'logo.png');
        $this->migrator->add('general.social_networks', [
            [
                'network' => 'facebook',
                'url' => 'https://www.facebook.com/',
            ],
            [
                'network' => 'twitter',
                'url' => 'https://www.twitter.com/',
            ],
            [
                'network' => 'instagram',
                'url' => 'https://www.instagram.com/',
            ],
            [
                'network' => 'youtube',
                'url' => 'https://www.youtube.com/',
            ],
            [
                'network' => 'tiktok',
                'url' => 'https://www.tiktok.com/',
            ],
        ]);
        $this->migrator->add('general.map_url', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3762.573110906543!2d-99.15567942399316!3d19.430842140735454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1ffcdab13eae1%3A0x4524628ee25469aa!2sSecretar%C3%ADa%20de%20Gobernaci%C3%B3n%20SEGOB!5e0!3m2!1ses!2sec!4v1735501018530!5m2!1ses!2sec" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>');
        $this->migrator->add('general.contact_content', '<p>&nbsp;Abraham González 48 Col.</p><p>Juárez 06600 Ciudad de México</p><p>Teléfono: 5552098800</p><p>Atención Ciudadana:</p><p>Secretaría de Gobernación.</p><p><br></p><p><strong>¿De qué se trata tu petición?</strong></p><p>Envía tus dudas o comentarios a</p><p>atencionciudadana@segob.gob.mx&nbsp;</p>');
    }

    public function down(): void
    {
        $this->migrator->delete('general.logo');
        $this->migrator->delete('general.social_networks');
    }
};
