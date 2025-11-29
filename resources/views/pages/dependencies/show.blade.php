@extends('layouts.app')

@section('title', $dependency->name . ' - Segob')

@section('content')
{{-- Banner --}}
<div class="flex justify-center bg-[#F1EDE1] -mx-4 -mt-8 py-6 mb-8">
    <img src="{{ $dependency->getFirstMediaUrl('banner') }}" alt="{{ $dependency->name }}" class="w-[20rem]" />
</div>

{{-- Posts Layout con filtros --}}
<x-posts.posts-layout
    :posts="$posts"
    :filters="$filters"
    route-name="dependencies.show"
    :route-params="['slug' => $dependency->slug]"
    :title="$dependency->name"
/>
@endsection
