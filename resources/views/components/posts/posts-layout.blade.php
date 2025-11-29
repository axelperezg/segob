@props([
    'posts',
    'title',
    'filters' => [],
    'showContentType' => true,
    'showDependency' => true,
    'showPublishedAt' => true,
    'showDocumentSection' => false,
    'documentSections' => [],
    'emptyMessage' => 'No hay publicaciones disponibles'
])

<div class="max-w-7xl mx-auto">
    <!-- Search and filters grid -->
    <div class="grid grid-cols-1 lg:grid-cols-[350px_1fr] gap-8">
        <!-- Left sidebar -->
        <x-posts.posts-filter
            :show-content-type="$showContentType"
            :show-dependency="$showDependency"
            :show-published-at="$showPublishedAt"
            :show-document-section="$showDocumentSection"
            :filters="$filters"
            :document-sections="$documentSections"
        />

        <!-- Right content -->
        <div>
            <h1 class="text-3xl font-medium mb-8">{{ $title }}</h1>
            <div class="space-y-6">
                @if($posts->count() === 0)
                    <div class="text-gray-500 text-center py-8 bg-gray-50 rounded-lg">
                        {{ $emptyMessage }}
                    </div>
                @else
                    @foreach($posts as $post)
                        <x-posts.post-article :post="$post" />
                    @endforeach

                    <!-- Pagination -->
                    @if($posts->hasPages())
                        <div class="mt-6">
                            {{ $posts->appends(request()->query())->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
