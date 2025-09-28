@extends('layout')

@section('title', $article->title)

@section('content')
<div class="card mb-4 shadow-sm">
    <div class="card-body text-center">
        <h1>{{ $article->title }}</h1>
        <p class="text-muted">Автор: {{ $article->user->name ?? 'Неизвестно' }}</p>

        @if($article->full_image)
            <div class="mb-3">
                <img src="{{ asset('images/' . $article->full_image) }}" 
                     alt="{{ $article->title }}" 
                     class="img-fluid mx-auto d-block" style="max-height: 400px;">
            </div>
        @endif

        <p>{{ $article->body }}</p>

        @can('update', $article)
            <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning btn-sm">Редактировать</a>
        @endcan

        @can('delete', $article)
            <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Удалить статью?')">Удалить</button>
            </form>
        @endcan
    </div>
</div>

<h3>Комментарии</h3>
@auth
    <form action="{{ route('comments.store', $article) }}" method="POST" class="mb-3">
        @csrf
        <div class="mb-2">
            <textarea name="body" class="form-control" rows="3" placeholder="Напишите комментарий..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Отправить</button>
    </form>
@else
    <p><a href="{{ route('login.form') }}">Войдите</a>, чтобы оставить комментарий.</p>
@endauth

@forelse($article->comments as $comment)
    <div class="border rounded p-2 mb-2">
        <p>{{ $comment->body }}</p>
        <small class="text-muted">Автор: {{ $comment->user->name ?? 'Неизвестно' }}, {{ $comment->created_at->diffForHumans() }}</small>

        @can('update', $comment)
            <a href="{{ route('comments.edit', $comment) }}" class="btn btn-warning btn-sm">Редактировать</a>
        @endcan
        @can('delete', $comment)
            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить комментарий?')">Удалить</button>
            </form>
        @endcan
    </div>
@empty
    <p>Комментариев пока нет.</p>
@endforelse
@endsection
