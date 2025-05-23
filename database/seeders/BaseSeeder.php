<?php

namespace Database\Seeders;

use App\Enums\Documents\DocumentTypeEnum;
use App\Enums\Posts\ContentTypeEnum;
use App\Models\Action;
use App\Models\Audio;
use App\Models\Banner;
use App\Models\Dependency;
use App\Models\Document;
use App\Models\FeaturedPost;
use App\Models\MexicoDependency;
use App\Models\MexicoNews;
use App\Models\PhotoGallery;
use App\Models\Post;
use App\Models\State;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Axel Pérez',
            'email' => 'axelperezg@gmail.com',
        ]);

        $this->createStates();
        $audio = Audio::factory()->create();
        // $audioUrl = 'https://sample-files.com/downloads/audio/mp3/sample-files.com_tone_test_audio.mp3';
        // $audio->addMediaFromUrl($audioUrl)->toMediaCollection('audio');

        $this->createInitialPosts();
        $this->createAdditionalPosts();

        $this->createActions();
        $this->createDependencies();

        Post::all()->each(function (Post $post) {
            $actions = Action::where('name', 'Cero Impunidad')->get();
            $post->actions()->attach($actions);
            $dependencies = Dependency::query()->where('slug', 'unidad-de-analisis-estrategicos-y-vinculacion-interinstitucional')->get();
            $post->dependencies()->attach($dependencies);

            $states = State::query()->inRandomOrder()->limit(rand(1, 3))->pluck('id')->toArray();

            $post->states()->attach($states);
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

        PhotoGallery::factory(12)->create();
        Video::factory(6)->create();
        Document::factory(6)->create(['type' => DocumentTypeEnum::INFOGRAPHIC]);
        Document::factory(10)->create(['type' => DocumentTypeEnum::PRESENTATION]);
        Banner::factory(4)->create();
    }

    private function createStates(): void
    {
        $states = [
            ['name' => 'Aguascalientes'],
            ['name' => 'Baja California'],
            ['name' => 'Baja California Sur'],
            ['name' => 'Campeche'],
            ['name' => 'Chiapas'],
            ['name' => 'Chihuahua'],
            ['name' => 'Ciudad de México'],
            ['name' => 'Coahuila'],
            ['name' => 'Colima'],
            ['name' => 'Durango'],
            ['name' => 'Estado de México'],
            ['name' => 'Guanajuato'],
            ['name' => 'Guerrero'],
            ['name' => 'Hidalgo'],
            ['name' => 'Jalisco'],
            ['name' => 'Michoacán'],
            ['name' => 'Morelos'],
            ['name' => 'Nayarit'],
            ['name' => 'Nuevo León'],
            ['name' => 'Oaxaca'],
            ['name' => 'Puebla'],
            ['name' => 'Querétaro'],
            ['name' => 'Quintana Roo'],
            ['name' => 'San Luis Potosí'],
            ['name' => 'Sinaloa'],
            ['name' => 'Sonora'],
            ['name' => 'Tabasco'],
            ['name' => 'Tamaulipas'],
            ['name' => 'Tlaxcala'],
            ['name' => 'Veracruz'],
            ['name' => 'Yucatán'],
            ['name' => 'Zacatecas'],
        ];

        foreach ($states as $state) {
            State::query()->create($state);
        }
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

    private function createAdditionalPosts(): void
    {
        Post::factory()->createMany([
            [
                'title' => 'Nuevo sistema de transporte sustentable',
                'content' => '<p>La Secretaría de Movilidad presenta un innovador sistema de transporte público que integra energías limpias y tecnologías inteligentes para mejorar la movilidad urbana.</p>',
                'slug' => 'nuevo-sistema-transporte-sustentable',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Programa de rescate del patrimonio histórico',
                'content' => '<p>El INAH lanza un ambicioso programa de restauración y conservación de monumentos históricos en todo el país, preservando la riqueza cultural de México.</p>',
                'slug' => 'programa-rescate-patrimonio-historico',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Innovación en energías renovables',
                'content' => '<p>México implementa nuevos proyectos de energía solar y eólica, consolidando su posición como líder regional en energías limpias y desarrollo sostenible.</p>',
                'slug' => 'innovacion-energias-renovables',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Programa de desarrollo artesanal',
                'content' => '<p>La Secretaría de Cultura impulsa un programa nacional para preservar y promover las artesanías tradicionales mexicanas en mercados internacionales.</p>',
                'slug' => 'programa-desarrollo-artesanal',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Modernización del sistema judicial',
                'content' => '<p>El Poder Judicial implementa nuevas tecnologías y procesos para agilizar los trámites judiciales y mejorar el acceso a la justicia.</p>',
                'slug' => 'modernizacion-sistema-judicial',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Plan nacional de seguridad alimentaria',
                'content' => '<p>La SADER presenta estrategias para garantizar la seguridad alimentaria mediante el apoyo a pequeños productores y la agricultura sustentable.</p>',
                'slug' => 'plan-nacional-seguridad-alimentaria',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Innovación en medicina preventiva',
                'content' => '<p>El sector salud implementa nuevos programas de medicina preventiva utilizando tecnologías avanzadas y estrategias comunitarias.</p>',
                'slug' => 'innovacion-medicina-preventiva',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Desarrollo de ciudades inteligentes',
                'content' => '<p>México impulsa la transformación de sus principales urbes en ciudades inteligentes mediante la implementación de tecnologías IoT y gestión eficiente.</p>',
                'slug' => 'desarrollo-ciudades-inteligentes',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Protección de ecosistemas marinos',
                'content' => '<p>La SEMARNAT implementa nuevas medidas para la conservación de ecosistemas marinos y la protección de especies en peligro de extinción.</p>',
                'slug' => 'proteccion-ecosistemas-marinos',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Fomento a la investigación científica',
                'content' => '<p>El gobierno federal aumenta el presupuesto para investigación científica y desarrollo tecnológico en universidades públicas.</p>',
                'slug' => 'fomento-investigacion-cientifica',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Programa de vivienda sustentable',
                'content' => '<p>La SEDATU lanza un programa innovador de vivienda que incorpora tecnologías verdes y diseños ecológicos para comunidades sustentables.</p>',
                'slug' => 'programa-vivienda-sustentable',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Fortalecimiento del turismo cultural',
                'content' => '<p>La Secretaría de Turismo desarrolla nuevas rutas culturales que destacan la riqueza histórica y artística de diferentes regiones del país.</p>',
                'slug' => 'fortalecimiento-turismo-cultural',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Innovación en educación digital',
                'content' => '<p>La SEP implementa nuevas plataformas educativas digitales para mejorar el acceso a la educación en zonas remotas.</p>',
                'slug' => 'innovacion-educacion-digital',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Desarrollo de energía geotérmica',
                'content' => '<p>México expande su capacidad de generación de energía geotérmica con nuevos proyectos en zonas volcánicas del país.</p>',
                'slug' => 'desarrollo-energia-geotermica',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
            [
                'title' => 'Modernización del sistema aduanero',
                'content' => '<p>El SAT implementa nuevas tecnologías y procesos para agilizar los trámites aduaneros y mejorar el comercio internacional.</p>',
                'slug' => 'modernizacion-sistema-aduanero',
                'is_published' => true,
                'created_by' => User::first()->id,
                'audio_id' => Audio::factory(),
                'document_id' => null,
            ],
        ]);
    }

    private function createInitialPosts(): void
    {
        Post::factory()->createMany([
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

        Post::factory(30)->create([
            'content_type' => ContentTypeEnum::STENOGRAPHIC_VERSION,
        ]);

        $dependenciesMexico = MexicoDependency::factory()->createMany([
            [
                'name' => 'Secretaría de Economía',
            ],
            [
                'name' => 'Secretaría de Bienestar',
            ],
            [
                'name' => 'Secretaría de Educación Pública',
            ],
            [
                'name' => 'Secretaría de Salud',
            ],
            [
                'name' => 'Secretaría de Hacienda',
            ],
        ]);

        foreach (range(1, 10) as $i) {
            MexicoNews::factory()->create([
                'url' => 'https://www.google.com',
                'mexico_dependency_id' => $dependenciesMexico->random()->id,
            ]);
        }
    }
}
