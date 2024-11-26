<?php

namespace App\Filament\Resources\FeaturedPostResource\Pages;

use App\Filament\Resources\FeaturedPostResource;
use App\Models\FeaturedPost;
use Filament\Resources\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use App\Models\Post;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class EditAllFeaturedPosts extends Page
{
    use InteractsWithForms;

    protected static string $resource = FeaturedPostResource::class;
    protected static string $view = 'filament.resources.featured-post-resource.pages.edit-all-featured-posts';

    public ?array $data = [];

    public function mount(): void
    {
        $featuredPosts = FeaturedPost::with('post')->orderBy('sort')->get();

        $this->form->fill([
            'featured_posts' => $featuredPosts->pluck('post_id')->toArray()
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('featured_posts')
                    ->hiddenLabel()
                    ->columnSpanFull()
                    ->simple(
                        Select::make('post_id')
                            ->label('Noticia')
                            ->required()
                            ->searchable()
                            ->options(
                                Post::query()
                                    ->orderBy('created_at', 'desc')
                                    ->get()
                                    ->pluck('title', 'id')
                                    ->toArray()
                            )
                    )
            ])
            ->statePath('data');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Guardar cambios')
                ->action('save')
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        FeaturedPost::query()->delete();

        foreach ($data['featured_posts'] as $index => $postId) {
            FeaturedPost::create([
                'post_id' => $postId,
                'sort' => $index + 1,
                'is_active' => true
            ]);
        }

        Notification::make()
            ->success()
            ->title('Posts destacados actualizados')
            ->send();

        $this->redirect(
            url: FeaturedPostResource::getUrl('index'),
            navigate: true
        );
    }

    public function getTitle(): string
    {
        return 'Editar Posts Destacados';
    }
}
