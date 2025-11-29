@props([
    'showContentType' => true,
    'showDependency' => true,
    'showPublishedAt' => true,
    'showDocumentSection' => false,
    'filters' => [],
    'documentSections' => [],
])

@php
    $contentTypes = \App\Helpers\ViewHelper::getContentTypes();
    $dependencies = \App\Helpers\ViewHelper::getDependencies();

    // Current filter values
    $search = $filters['title'] ?? '';
    $publishedAt = $filters['published_at'] ?? '';
    $contentTypesSelected = $filters['content_type'] ?? [];
    $dependencySelected = $filters['dependency_id'] ?? '';
    $documentSectionSelected = $filters['document_section'] ?? '';
@endphp

<div
    class="space-y-6"
    x-data="{
        search: '{{ $search }}',
        publishedAt: '{{ $publishedAt }}',
        contentTypesSelected: {{ json_encode($contentTypesSelected) }},
        dependencySelected: '{{ $dependencySelected }}',
        documentSectionSelected: '{{ $documentSectionSelected }}',
        searchTimeout: null,

        submitFilters() {
            const params = new URLSearchParams(window.location.search);
            params.set('title', this.search);
            params.set('published_at', this.publishedAt);
            params.set('dependency_id', this.dependencySelected);
            params.set('document_section', this.documentSectionSelected);

            // Handle array for content types
            params.delete('content_type[]');
            this.contentTypesSelected.forEach(type => {
                params.append('content_type[]', type);
            });

            window.location.href = window.location.pathname + '?' + params.toString();
        },

        onSearchInput() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.submitFilters();
            }, 500);
        },

        clearFilters() {
            window.location.href = window.location.pathname;
        }
    }"
>
    <div class="bg-gray-100 shadow px-4 py-8 rounded-lg space-y-6">
        <!-- Search -->
        <div>
            <h2 class="text-3xl mb-2 font-bold">Búsqueda</h2>
            <div class="relative">
                <input
                    x-model="search"
                    @input="onSearchInput()"
                    type="text"
                    placeholder="Ingresa una palabra clave"
                    class="block w-full rounded-md bg-white px-3 py-3 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                />
            </div>
        </div>

        <!-- Content Type Filter -->
        @if($showContentType)
            <div>
                <h2 class="text-xl mb-4 font-medium">Tipo de Contenido</h2>
                <div class="space-y-2">
                    @foreach($contentTypes as $type)
                        <div class="flex items-center gap-2">
                            <input
                                type="checkbox"
                                id="type-{{ $type['id'] }}"
                                value="{{ $type['id'] }}"
                                class="segob-checkbox"
                                x-model="contentTypesSelected"
                                @change="submitFilters()"
                            />
                            <label class="font-medium" for="type-{{ $type['id'] }}">
                                {{ $type['name'] }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Date Filter -->
        @if($showPublishedAt)
            <div>
                <h2 class="text-xl mb-4">Fecha</h2>
                <input
                    type="date"
                    x-model="publishedAt"
                    @change="submitFilters()"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black"
                />
            </div>
        @endif

        <!-- Dependency Filter -->
        @if($showDependency)
            <div>
                <h2 class="text-xl mb-4">Dependencia</h2>
                <select
                    x-model="dependencySelected"
                    @change="submitFilters()"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black"
                >
                    <option value="">Todas las dependencias</option>
                    @foreach($dependencies as $dependency)
                        <option value="{{ $dependency['id'] }}">
                            {{ $dependency['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <!-- Document Section Filter -->
        @if($showDocumentSection && count($documentSections) > 0)
            <div>
                <h2 class="text-xl mb-4">Sección del Documento</h2>
                <select
                    x-model="documentSectionSelected"
                    @change="submitFilters()"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black"
                >
                    <option value="">Todas las secciones</option>
                    @foreach($documentSections as $section)
                        <option value="{{ $section->id }}">
                            {{ $section->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <!-- Clear Filters Button -->
        <button
            type="button"
            class="w-full px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-md transition-colors"
            @click="clearFilters()"
        >
            Limpiar filtros
        </button>
    </div>
</div>
