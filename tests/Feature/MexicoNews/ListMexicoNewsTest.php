<?php

namespace Tests\Feature\MexicoNews;

use App\Filament\Resources\MexicoNewsResource;
use App\Filament\Resources\MexicoNewsResource\Pages\ListMexicoNews;
use App\Models\Dependency;
use App\Models\MexicoNews;
use Livewire\Livewire;
use Tests\TestCase;

class ListMexicoNewsTest extends TestCase
{
    public function test_can_render_page()
    {
        $response = $this->get(MexicoNewsResource::getUrl('index'));

        $response->assertOk();
    }

    public function test_can_list_mexico_news()
    {
        // Arrange
        $dependency = Dependency::factory()->create();
        $news = MexicoNews::factory()->count(3)->create([
            'dependency_id' => $dependency->id
        ]);
        
        $component = Livewire::test(ListMexicoNews::class);

        // Assert
        foreach ($news as $item) {
            $component->assertSee($item->title);
        }
    }

    public function test_can_sort_mexico_news_by_title()
    {
        // Arrange
        $dependency = Dependency::factory()->create();
        MexicoNews::factory()->create([
            'title' => 'Z News',
            'dependency_id' => $dependency->id
        ]);
        MexicoNews::factory()->create([
            'title' => 'A News',
            'dependency_id' => $dependency->id
        ]);
        MexicoNews::factory()->create([
            'title' => 'M News',
            'dependency_id' => $dependency->id
        ]);

        // Act & Assert
        Livewire::test(ListMexicoNews::class)
            ->assertCanSeeTableRecords([
                ['title' => 'A News'],
                ['title' => 'M News'],
                ['title' => 'Z News'],
            ], inOrder: false)
            ->sortTable('title')
            ->assertCanSeeTableRecords([
                ['title' => 'A News'],
                ['title' => 'M News'],
                ['title' => 'Z News'],
            ], inOrder: true);
    }

    public function test_can_search_mexico_news()
    {
        // Arrange
        $dependency = Dependency::factory()->create();
        MexicoNews::factory()->create([
            'title' => 'Primera noticia',
            'dependency_id' => $dependency->id
        ]);
        MexicoNews::factory()->create([
            'title' => 'Segunda noticia',
            'dependency_id' => $dependency->id
        ]);
        MexicoNews::factory()->create([
            'title' => 'Noticia importante',
            'dependency_id' => $dependency->id
        ]);

        // Act & Assert
        Livewire::test(ListMexicoNews::class)
            ->searchTable('importante')
            ->assertCanSeeTableRecords([
                ['title' => 'Noticia importante'],
            ])
            ->assertCanNotSeeTableRecords([
                ['title' => 'Primera noticia'],
                ['title' => 'Segunda noticia'],
            ]);
    }
} 