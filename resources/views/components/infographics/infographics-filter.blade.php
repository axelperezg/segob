@props(['filters', 'documentSections'])

<div class="bg-white rounded-lg shadow-sm p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Filtros</h2>

    <form method="GET" action="{{ route('infographics.index') }}" x-data="{ filters: {{ json_encode($filters) }} }">
        <!-- Title Search -->
        <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                Buscar por título
            </label>
            <input
                type="text"
                id="title"
                name="title"
                x-model="filters.name"
                placeholder="Escribe el título..."
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-burgundy focus:border-burgundy"
            />
        </div>

        <!-- Document Section -->
        <div class="mb-6">
            <label for="document_section" class="block text-sm font-medium text-gray-700 mb-2">
                Sección
            </label>
            <select
                id="document_section"
                name="document_section"
                x-model="filters.document_section"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-burgundy focus:border-burgundy"
            >
                <option value="">Todas las secciones</option>
                @foreach($documentSections as $section)
                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Buttons -->
        <div class="flex gap-2">
            <button
                type="submit"
                class="flex-1 bg-burgundy text-white px-4 py-2 rounded-md hover:bg-burgundy-soft transition-colors"
            >
                Aplicar filtros
            </button>
            <a
                href="{{ route('infographics.index') }}"
                class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition-colors text-center"
            >
                Limpiar
            </a>
        </div>
    </form>
</div>
