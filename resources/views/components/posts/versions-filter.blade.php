@props(['filters'])

<div class="bg-white rounded-lg shadow-sm p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Filtros</h2>

    <form method="GET" action="{{ route('versions.index') }}" x-data="{ filters: {{ json_encode($filters) }} }">
        <!-- Title Search -->
        <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                Buscar por título
            </label>
            <input
                type="text"
                id="title"
                name="title"
                x-model="filters.title"
                placeholder="Escribe el título..."
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-burgundy focus:border-burgundy"
            />
        </div>

        <!-- Published Date -->
        <div class="mb-6">
            <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">
                Fecha de publicación
            </label>
            <input
                type="date"
                id="published_at"
                name="published_at"
                x-model="filters.published_at"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-burgundy focus:border-burgundy"
            />
        </div>

        <!-- Dependency -->
        <div class="mb-6">
            <label for="dependency_id" class="block text-sm font-medium text-gray-700 mb-2">
                Dependencia
            </label>
            <select
                id="dependency_id"
                name="dependency_id"
                x-model="filters.dependency_id"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-burgundy focus:border-burgundy"
            >
                <option value="">Todas las dependencias</option>
                @foreach(\App\Models\Dependency::all() as $dependency)
                    <option value="{{ $dependency->id }}">{{ $dependency->name }}</option>
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
                href="{{ route('versions.index') }}"
                class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition-colors text-center"
            >
                Limpiar
            </a>
        </div>
    </form>
</div>
