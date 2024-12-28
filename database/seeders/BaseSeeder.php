<?php

namespace Database\Seeders;

use App\Enums\Documents\DocumentTypeEnum;
use App\Models\Action;
use App\Models\Audio;
use App\Models\Banner;
use App\Models\Dependency;
use App\Models\Document;
use App\Models\FeaturedPost;
use App\Models\PhotoGallery;
use App\Models\Post;
use App\Models\User;
use App\Models\Video;
use App\Settings\AppSettings;
use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Miguel Bonifaz',
            'email' => 'miguel@gmail.com',
        ]);
        $audio = Audio::factory()->create();
        $audioUrl = 'https://sample-files.com/downloads/audio/mp3/sample-files.com_tone_test_audio.mp3';
        $audio->addMediaFromUrl($audioUrl)->toMediaCollection('audio');

        Post::factory()->withImage()->createMany([
            [
                'title' => 'México fortalece lazos comerciales con América Latina',
                'content' => '<p>El gobierno mexicano anunció hoy nuevos acuerdos comerciales con países de América Latina, fortaleciendo la integración económica regional. Durante la cumbre realizada en Ciudad de México, representantes de diversos países firmaron convenios que facilitarán el intercambio comercial y la cooperación económica.</p>',
                'slug' => 'mexico-fortalece-lazos-comerciales-america-latina',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Nueva política de desarrollo social beneficiará a millones de mexicanos',
                'content' => '<p>La Secretaría de Bienestar presentó un ambicioso programa de desarrollo social que busca reducir la desigualdad en el país. El plan incluye inversiones significativas en educación, salud y vivienda, con especial énfasis en las comunidades más vulnerables.</p>',
                'slug' => 'nueva-politica-desarrollo-social-beneficiara-millones-mexicanos',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Inversión histórica en infraestructura para el sur de México',
                'content' => '<p>El gobierno federal anuncia una inversión sin precedentes en infraestructura para los estados del sur del país. El proyecto incluye la construcción de nuevas carreteras, puentes y sistemas de transporte público que impulsarán el desarrollo económico de la región.</p>',
                'slug' => 'inversion-historica-infraestructura-sur-mexico',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'México lidera iniciativas ambientales en América Latina',
                'content' => '<p>En el marco de la conferencia internacional sobre cambio climático, México presentó un plan integral de protección ambiental que incluye medidas para reducir emisiones de carbono y promover energías renovables. El programa ha sido reconocido como un modelo a seguir en la región.</p>',
                'slug' => 'mexico-lidera-iniciativas-ambientales-america-latina',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Programa nacional de digitalización gubernamental',
                'content' => '<p>La Secretaría de la Función Pública implementará un nuevo sistema digital que modernizará los servicios gubernamentales. Esta iniciativa busca mejorar la eficiencia administrativa y facilitar el acceso de los ciudadanos a los servicios públicos.</p>',
                'slug' => 'programa-nacional-digitalizacion-gubernamental',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Avances en seguridad pública muestran resultados positivos',
                'content' => '<p>El gobierno federal presenta los resultados de su estrategia de seguridad pública, mostrando una reducción significativa en los índices delictivos en varias regiones del país. El informe destaca la importancia de la coordinación entre los diferentes niveles de gobierno.</p>',
                'slug' => 'avances-seguridad-publica-muestran-resultados-positivos',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Plan nacional de innovación tecnológica en educación',
                'content' => '<p>La Secretaría de Educación Pública presenta un ambicioso plan para integrar nuevas tecnologías en las aulas de todo el país. El programa incluye la distribución de equipos de cómputo, capacitación docente y desarrollo de contenidos educativos digitales.</p>',
                'slug' => 'plan-nacional-innovacion-tecnologica-educacion',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Impulso al turismo sustentable en zonas arqueológicas',
                'content' => '<p>El Instituto Nacional de Antropología e Historia implementa nuevas estrategias para promover el turismo sustentable en zonas arqueológicas. El proyecto busca preservar el patrimonio cultural mientras se genera desarrollo económico local.</p>',
                'slug' => 'impulso-turismo-sustentable-zonas-arqueologicas',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Programa de modernización del sistema de salud',
                'content' => '<p>La Secretaría de Salud anuncia una importante inversión para modernizar hospitales y centros de salud en todo el país. El programa incluye la adquisición de equipo médico de última generación y mejoras en la infraestructura sanitaria.</p>',
                'slug' => 'programa-modernizacion-sistema-salud',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Fortalecimiento de programas culturales comunitarios',
                'content' => '<p>La Secretaría de Cultura amplía su red de centros culturales comunitarios, llevando actividades artísticas y culturales a más regiones del país. La iniciativa busca promover la inclusión social a través del arte y la cultura.</p>',
                'slug' => 'fortalecimiento-programas-culturales-comunitarios',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Nueva estrategia nacional de ciencia y tecnología',
                'content' => '<p>El CONACYT presenta su nueva estrategia para impulsar la investigación científica y el desarrollo tecnológico en México. El plan incluye mayores recursos para proyectos de investigación y colaboraciones internacionales.</p>',
                'slug' => 'nueva-estrategia-nacional-ciencia-tecnologia',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Plan integral de desarrollo urbano sustentable',
                'content' => '<p>La SEDATU implementa un nuevo plan de desarrollo urbano que prioriza la sustentabilidad y la calidad de vida en las ciudades mexicanas. El programa incluye mejoras en transporte público y espacios verdes.</p>',
                'slug' => 'plan-integral-desarrollo-urbano-sustentable',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Fortalecimiento de la economía social y solidaria',
                'content' => '<p>La Secretaría de Economía lanza nuevos programas para apoyar a cooperativas y empresas sociales. La iniciativa busca promover un modelo económico más inclusivo y equitativo.</p>',
                'slug' => 'fortalecimiento-economia-social-solidaria',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Programa nacional de prevención de adicciones',
                'content' => '<p>La CONADIC presenta una nueva estrategia integral para la prevención y tratamiento de adicciones. El programa enfatiza la importancia de la prevención temprana y el apoyo comunitario.</p>',
                'slug' => 'programa-nacional-prevencion-adicciones',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Innovación en servicios financieros digitales',
                'content' => '<p>La CNBV anuncia nuevas regulaciones para promover la innovación en servicios financieros digitales. Las medidas buscan aumentar la inclusión financiera y la competencia en el sector.</p>',
                'slug' => 'innovacion-servicios-financieros-digitales',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Estrategia nacional de agricultura sostenible',
                'content' => '<p>La SADER implementa un nuevo programa para promover prácticas agrícolas sostenibles. La iniciativa incluye apoyo técnico y financiero para pequeños productores y comunidades rurales.</p>',
                'slug' => 'estrategia-nacional-agricultura-sostenible',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
        ]);

        $this->createActions();
        $this->createDependencies();

        Post::all()->each(function (Post $post) {
            $actions = Action::where('name', 'Cero Impunidad')->get();
            $post->actions()->attach($actions);
            $dependencies = Dependency::query()->where('slug', 'unidad-de-analisis-estrategicos-y-vinculacion-interinstitucional')->get();
            $post->dependencies()->attach($dependencies);
        });

        FeaturedPost::query()->create([
            'post_id' => 1,
            'sort' => 1,
        ]);
        FeaturedPost::query()->create([
            'post_id' => 2,
            'sort' => 2,
        ]);
        FeaturedPost::query()->create([
            'post_id' => 3,
            'sort' => 3,
        ]);
        FeaturedPost::query()->create([
            'post_id' => 4,
            'sort' => 4,
        ]);
        FeaturedPost::query()->create([
            'post_id' => 5,
            'sort' => 5,
        ]);
        FeaturedPost::query()->create([
            'post_id' => 6,
            'sort' => 6,
        ]);

        PhotoGallery::factory(6)->withImage()->create();
        Video::factory(6)->withImage()->create();
        Document::factory(6)->create(['type' => DocumentTypeEnum::INFOGRAPHIC]);
        Banner::factory(4)->withImage()->create();
    }

    private function createActions()
    {
        return Action::factory()->createMany([
            [
                'name' => '+ Beis - Violencia',
            ],
            [
                'name' => 'Cero Impunidad',
            ],
            [
                'name' => 'Ciberguía',
            ],
            [
                'name' => 'Constructores de Paz',
            ],
            [
                'name' => 'Ferias de Paz y Desarme Voluntario',
            ],
            [
                'name' => 'Mi yo digital',
            ],
            [
                'name' => 'ONPRENNA',
            ],
            [
                'name' => 'Tianguis del Bienestar',
            ],
        ]);
    }

    private function createDependencies()
    {
        return Dependency::factory()->createMany([
            ['name' => 'Sistema Nacional de Protección Civil (SINAPROC)', 'slug' => 'sistema-nacional-de-proteccion-civil-sinaproc'],
            ['name' => 'Protección Federal', 'slug' => 'proteccion-federal'],
            ['name' => 'Prevención y Readaptación Social', 'slug' => 'prevencion-y-readaptacion-social'],
            ['name' => 'Guardia Nacional (GN)', 'slug' => 'guardia-nacional-gn'],
            ['name' => 'Coordinación Nacional Antisecuestro (CONASE)', 'slug' => 'coordinacion-nacional-antisecuestro-conase'],
            ['name' => 'Coordinación Nacional de Protección Civil (CNPC)', 'slug' => 'coordinacion-nacional-de-proteccion-civil-cnpc'],
            ['name' => 'Centro Nacional de Inteligencia (CNI)', 'slug' => 'centro-nacional-de-inteligencia-cni'],
            ['name' => 'Centro Nacional de Prevención de Desastres (CENAPRED)', 'slug' => 'centro-nacional-de-prevencion-de-desastres-cenapred'],
            ['name' => 'Secretariado Ejecutivo del Sistema Nacional de Se   guridad Pública', 'slug' => 'secretariado-ejecutivo-del-sistema-nacional-de-seguridad-publica'],
            ['name' => 'Subsecretario de Seguridad Pública', 'slug' => 'subsecretario-de-seguridad-publica'],
            ['name' => 'Unidad de Información, Infraestructura Informática y Vinculación Tecnológica', 'slug' => 'unidad-de-informacion-infraestructura-informatica-y-vinculacion-tecnologica'],
            ['name' => 'Unidad de Política Policial, Penitenciaria y Seguridad Privada', 'slug' => 'unidad-de-politica-policial-penitenciaria-y-seguridad-privada'],
            ['name' => 'Unidad de Prevención de la Violencia y el Delito', 'slug' => 'unidad-de-prevencion-de-la-violencia-y-el-delito'],
            ['name' => 'Unidad de Planeación y Evaluación Institucional', 'slug' => 'unidad-de-planeacion-y-evaluacion-institucional'],
            ['name' => 'Unidad de Políticas y Estrategias para la Construcción de Paz con Entidades Federativas y Regiones', 'slug' => 'unidad-de-politicas-y-estrategias-para-la-construccion-de-paz-con-entidades-federativas-y-regiones'],
            ['name' => 'Unidad de Análisis Estratégicos y Vinculación Interinstitucional', 'slug' => 'unidad-de-analisis-estrategicos-y-vinculacion-interinstitucional'],
            ['name' => 'Secretaría de Seguridad y Protección Ciudadana (SSPC)', 'slug' => 'secretaria-de-seguridad-y-proteccion-ciudadana-sspc'],
        ]);
    }
}
