<?php

namespace App\Filament\Resources\FeaturedPostResource\Pages;

use App\Filament\Resources\FeaturedPostResource;
use App\Models\FeaturedPost;
use App\Models\Post;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;

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
            'featured_posts' => $featuredPosts->pluck('post_id')->toArray(),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('featured_posts')
                    ->hiddenLabel()
                    ->maxItems(6)
                    ->columnSpanFull()
                    ->addActionLabel('Agregar post destacado')
                    ->simple(
                        Select::make('post_id')
                            ->label('Noticia')
                            ->required()
                            ->searchable()
                            ->options(
                                function () {
                                    $selectedPostIds = collect($this->data['featured_posts'] ?? [])
                                        ->filter(fn ($post) => ! empty($post['post_id']))
                                        ->pluck('post_id')
                                        ->toArray();

                                    return Post::query()
                                        ->whereNotIn('id', $selectedPostIds)
                                        ->orderBy('created_at', 'desc')
                                        ->get()
                                        ->pluck('title', 'id')
                                        ->toArray();
                                }
                            )
                    ),
            ])
            ->statePath('data');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Guardar cambios')
                ->action('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $totalData = count($data['featured_posts']);

        if ($totalData !== 6 && $totalData !== 0) {
            Notification::make()
                ->danger()
                ->title('Error')
                ->body('Debe seleccionar exactamente 6 posts destacados.')
                ->send();

            return;
        }

        FeaturedPost::query()->delete();

        foreach ($data['featured_posts'] as $index => $postId) {
            FeaturedPost::query()->create([
                'post_id' => $postId,
                'sort' => $index + 1,
                'is_active' => true,
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
