@extends('layouts.app')

@section('title', 'Documentos')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-[350px_1fr] gap-8">
            <!-- Left sidebar - Filters -->
            <x-posts.posts-filter
                :show-content-type="false"
                :show-dependency="false"
                :show-published-at="false"
                :show-document-section="true"
                :filters="$filters"
                :document-sections="$documentSections"
            />

            <!-- Right content - Documents Grid -->
            <div>
                <h1 class="text-3xl font-medium mb-8">Documentos</h1>
                <div class="space-y-6">
                    @if($documents->count() === 0)
                        <div class="text-gray-500 text-center py-8 bg-gray-50 rounded-lg">
                            No hay documentos disponibles
                        </div>
                    @else
                        <div class="grid grid-cols-1 gap-10 md:grid-cols-2 xl:grid-cols-3">
                            @foreach($documents as $document)
                                <x-documents.document-article :document="$document" />
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($documents->hasPages())
                            <div class="mt-6">
                                {{ $documents->appends(request()->query())->links() }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
