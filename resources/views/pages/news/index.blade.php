@extends('layouts.app')

@section('title', 'Noticias')

@section('content')
    <x-posts.posts-layout
        :posts="$posts"
        title="Noticias"
        :filters="$filters"
        :show-dependency="false"
    />
@endsection
