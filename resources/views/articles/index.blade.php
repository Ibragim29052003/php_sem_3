@extends('layout')

@section('title', 'Статьи')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center">Статьи</h1>

    <div class="row g-4">
        @foreach($articles as $article)
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h3>
                            <a href="{{ url('/api/articles/' . $article->id) }}" class="text-decoration-none">
                                {{ $article->title }}
                            </a>
                        </h3>
                        <p class="text-muted mb-2">Автор: {{ $article->user->name ?? 'Неизвестно' }}</p>
                        <p>{{ Str::limit($article->body, 200) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
