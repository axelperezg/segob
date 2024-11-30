<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\Dependency;
use App\Models\FeaturedPost;
use App\Models\Post;
use App\Models\User;
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
        Post::factory()->createMany([
            [
                'title' => 'México fortalece lazos comerciales con América Latina',
                'content' => '<p>El gobierno mexicano anunció hoy nuevos acuerdos comerciales con países de América Latina, fortaleciendo la integración económica regional. Durante la cumbre realizada en Ciudad de México, representantes de diversos países firmaron convenios que facilitarán el intercambio comercial y la cooperación económica.</p>',
                'slug' => 'mexico-fortalece-lazos-comerciales-america-latina',
                'is_published' => true,
                'created_by' => User::first()->id,
            ],
            [
                'title' => 'Nueva política de desarrollo social beneficiará a millones de mexicanos',
                'content' => '<p>La Secretaría de Bienestar presentó un ambicioso programa de desarrollo social que busca reducir la desigualdad en el país. El plan incluye inversiones significativas en educación, salud y vivienda, con especial énfasis en las comunidades más vulnerables.</p>',
                'slug' => 'nueva-politica-desarrollo-social-beneficiara-millones-mexicanos',
                'is_published' => true,
                'created_by' => User::first()->id,
            ],
            [
                'title' => 'Inversión histórica en infraestructura para el sur de México',
                'content' => '<p>El gobierno federal anuncia una inversión sin precedentes en infraestructura para los estados del sur del país. El proyecto incluye la construcción de nuevas carreteras, puentes y sistemas de transporte público que impulsarán el desarrollo económico de la región.</p>',
                'slug' => 'inversion-historica-infraestructura-sur-mexico',
                'is_published' => true,
                'created_by' => User::first()->id,
            ],
            [
                'title' => 'México lidera iniciativas ambientales en América Latina',
                'content' => '<p>En el marco de la conferencia internacional sobre cambio climático, México presentó un plan integral de protección ambiental que incluye medidas para reducir emisiones de carbono y promover energías renovables. El programa ha sido reconocido como un modelo a seguir en la región.</p>',
                'slug' => 'mexico-lidera-iniciativas-ambientales-america-latina',
                'is_published' => true,
                'created_by' => User::first()->id,
            ],
            [
                'title' => 'Programa nacional de digitalización gubernamental',
                'content' => '<p>La Secretaría de la Función Pública implementará un nuevo sistema digital que modernizará los servicios gubernamentales. Esta iniciativa busca mejorar la eficiencia administrativa y facilitar el acceso de los ciudadanos a los servicios públicos.</p>',
                'slug' => 'programa-nacional-digitalizacion-gubernamental',
                'is_published' => true,
                'created_by' => User::first()->id,
            ],
            [
                'title' => 'Avances en seguridad pública muestran resultados positivos',
                'content' => '<p>El gobierno federal presenta los resultados de su estrategia de seguridad pública, mostrando una reducción significativa en los índices delictivos en varias regiones del país. El informe destaca la importancia de la coordinación entre los diferentes niveles de gobierno.</p>',
                'slug' => 'avances-seguridad-publica-muestran-resultados-positivos',
                'is_published' => true,
                'created_by' => User::first()->id,
            ],
        ]);

        $this->createActions();
        $this->createDependencies();

        Post::all()->each(function (Post $post) {
            $actions = Action::all()->take(rand(2, 4));
            $post->actions()->attach($actions);
            $dependencies = Dependency::all()->take(rand(2, 4));
            $post->dependencies()->attach($dependencies);
        });

        FeaturedPost::create([
            'post_id' => 1,
            'sort' => 1,
        ]);
        FeaturedPost::create([
            'post_id' => 2,
            'sort' => 2,
        ]);
        FeaturedPost::create([
            'post_id' => 3,
            'sort' => 3,
        ]);
        FeaturedPost::create([
            'post_id' => 4,
            'sort' => 4,
        ]);
        FeaturedPost::create([
            'post_id' => 5,
            'sort' => 5,
        ]);
        FeaturedPost::create([
            'post_id' => 6,
            'sort' => 6,
        ]);

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
            ['name' => 'Sistema Nacional de Protección Civil (SINAPROC)'],
            ['name' => 'Protección Federal'],
            ['name' => 'Prevención y Readaptación Social'],
            ['name' => 'Guardia Nacional (GN)'],
            ['name' => 'Coordinación Nacional Antisecuestro (CONASE)'],
            ['name' => 'Coordinación Nacional de Protección Civil (CNPC)'],
            ['name' => 'Centro Nacional de Inteligencia (CNI)'],
            ['name' => 'Centro Nacional de Prevención de Desastres (CENAPRED)'],
            ['name' => 'Secretariado Ejecutivo del Sistema Nacional de Seguridad Pública'],
            ['name' => 'Subsecretario de Seguridad Pública'],
            ['name' => 'Unidad de Información, Infraestructura Informática y Vinculación Tecnológica'],
            ['name' => 'Unidad de Política Policial, Penitenciaria y Seguridad Privada'],
            ['name' => 'Unidad de Prevención de la Violencia y el Delito'],
            ['name' => 'Unidad de Planeación y Evaluación Institucional'],
            ['name' => 'Unidad de Políticas y Estrategias para la Construcción de Paz con Entidades Federativas y Regiones'],
            ['name' => 'Unidad de Análisis Estratégicos y Vinculación Interinstitucional'],
            ['name' => 'Secretaría de Seguridad y Protección Ciudadana (SSPC)'],
        ]);
    }
}
