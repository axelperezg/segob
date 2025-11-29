@extends('layouts.app')

@section('title', 'Infografías - Segob')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-[350px_1fr] gap-8">
        <!-- Filters Sidebar -->
        <x-infographics.infographics-filter :filters="$filters" :documentSections="$documentSections" />

        <!-- Content Area -->
        <div>
            <h1 class="text-3xl font-medium mb-8">Infografías</h1>
            <div class="space-y-6">
                @if($infographics->isEmpty())
                    <div class="text-gray-500 text-center py-8 bg-gray-50 rounded-lg">
                        No hay infografías disponibles
                    </div>
                @else
                    <div class="grid grid-cols-1 gap-10 md:grid-cols-2 xl:grid-cols-3">
                        @foreach($infographics as $infographic)
                            <x-infographics.infographic-article :infographic="$infographic" />
                        @endforeach
                    </div>

                    @if($infographics->hasPages())
                        <div class="mt-6">
                            {{ $infographics->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
