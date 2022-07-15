@extends('layouts.dashboard')

@section('content')
    <h1> {{ $post->title }} </h1>
    @if ($post->cover)
        <img src="{{ asset('storage/' . $post->cover) }}" alt="">
    @endif
    <p>Slug: {{ $post->slug }}</p>
    {{-- <p>Categoria: {{ $post->category ? $post->category->name : 'nessuna categoria' }}</p> --}}
    <p>Categoria: {{ $category ? $category->name : 'nessuna categoria' }}</p>

    <p><strong>Tags: </strong>
        @forelse ($post->tags as $tag)
            {{ $tag->name }}{{ $loop->last ? '' : ', ' }}
        @empty
            nessuno
        @endforelse
    </p>

    {{-- @if ($post->tags->isNotEmpty())
        <p><strong>Tags</strong>
            @foreach ($post->tags as $tag)
                {{ $tag->name }}{{ $loop->last ? '' : ', ' }}
            @endforeach
        </p>
    @endif --}}

    <p>{{ $post->content }}</p>

    <div class="d-flex">
        <a class="btn btn-primary" href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">Modifica</a>

        <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger" type="submit">Cancella</button>
        </form>
    </div>
@endsection
