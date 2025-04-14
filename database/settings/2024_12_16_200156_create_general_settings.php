<?php

use Illuminate\Support\Facades\Storage;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $logo = storage_path('app/public/logo-transparent.png');
        $logoMexico = storage_path('app/public/estados-unidos-mexicanos.svg');

        if (file_exists($logo)) {
            Storage::disk('public')->put('logo-transparent.png', file_get_contents($logo));
        }

        if (file_exists($logoMexico)) {
            Storage::disk('public')->put('logo-mexico.svg', file_get_contents($logoMexico));
        }

        $this->migrator->add('general.logo', 'logo-transparent.png');
        $this->migrator->add('general.mexico_logo', 'logo-mexico.svg');
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
        $this->migrator->add('general.map_url', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3762.573110906543!2d-99.15567942399316!3d19.430842140735454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1ffcdab13eae1%3A0x4524628ee25469aa!2sSecretar%C3%ADa%20de%20Gobernaci%C3%B3n%20SEGOB!5e0!3m2!1ses!2sec!4v1735501018530!5m2!1ses!2sec" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>');
        $this->migrator->add('general.contact_content', '<p>&nbsp;Abraham González 48 Col.</p><p>Juárez 06600 Ciudad de México</p><p>Teléfono: 5552098800</p><p>Atención Ciudadana:</p><p>Secretaría de Gobernación.</p><p><br></p><p><strong>¿De qué se trata tu petición?</strong></p><p>Envía tus dudas o comentarios a</p><p>atencionciudadana@segob.gob.mx&nbsp;</p>');
        $this->migrator->add('general.footer_links', [
            [
                'title' => 'Enlaces',
                'links' => [
                    [
                        'title' => 'Participa',
                        'url' => '/participa',
                    ],
                    [
                        'title' => 'Publicaciones Oficiales',
                        'url' => '/publicaciones',
                    ],
                    [
                        'title' => 'Marco Jurídico',
                        'url' => '/marco-juridico',
                    ],
                    [
                        'title' => 'Plataforma Nacional de Transparencia',
                        'url' => '/transparencia',
                    ],
                ],
            ],
            [
                'title' => '¿Qué es gob.mx?',
                'links' => [
                    [
                        'title' => 'Es el portal único de trámites, información y participación ciudadana',
                        'url' => '/que-es-gobmx',
                    ],
                    [
                        'title' => 'Portal de datos abiertos',
                        'url' => '/datos',
                    ],
                    [
                        'title' => 'Declaración de accesibilidad',
                        'url' => '/accesibilidad',
                    ],
                    [
                        'title' => 'Aviso de privacidad integral',
                        'url' => '/privacidad',
                    ],
                    [
                        'title' => 'Aviso de privacidad simplificado',
                        'url' => '/privacidad-simplificado',
                    ],
                    [
                        'title' => 'Términos y Condiciones',
                        'url' => '/terminos',
                    ],
                    [
                        'title' => 'Política de seguridad',
                        'url' => '/seguridad',
                    ],
                    [
                        'title' => 'Mapa de sitio',
                        'url' => '/mapa-sitio',
                    ],
                ],
            ],
            [
                'title' => 'Contacto',
                'links' => [
                    [
                        'title' => 'Dudas e información www.gob.mx/tramites/ficha/presentacion-de-quejas-y-denuncias-en-la-sfp/SFP54',
                        'url' => 'https://www.gob.mx/tramites/ficha/presentacion-de-quejas-y-denuncias-en-la-sfp/SFP54',
                    ],
                ],
            ],
        ]);
    }

    public function down(): void
    {
        $this->migrator->delete('general.logo');
        $this->migrator->delete('general.social_networks');
    }
};
