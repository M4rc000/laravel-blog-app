{{-- @dd($posts) --}}

@extends('layouts.main')
@section('container')
    <h4 class="mb-4">User: {{ $name }}</h4>
    @foreach ($posts as $post)
        <article class="mb-3">
            <ul>
                <li>

                    <h2>
                        <a href="/blog/{{ $post->slug }}" style="text-decoration: none">
                            {{ $post->title }}
                        </a>
                    </h2>
                </li>
            </ul>
        </article>
    @endforeach
@endsection