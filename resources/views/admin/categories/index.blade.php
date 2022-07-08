@extends('layouts.dashboard')

@section('content')
    <h2>Lista di categorie</h2>
    <ul>
        @foreach ($categories as $category)
            <li>
                <a href="{{ route('admin.categories.show', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection
