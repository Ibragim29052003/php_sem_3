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

        {{-- REST API ссылки закомментированы --}}
        {{-- @can('update', $article)
            <a href="{{ url('/api/articles/' . $article->id . '/edit') }}" class="btn btn-warning btn-sm">Редактировать</a>
        @endcan

        @can('delete', $article)
            <form action="{{ url('/api/articles/' . $article->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
            </form>
        @endcan --}}
    </div>
</div>

<h3>Комментарии</h3>
@auth
    {{-- REST API комментариев --}}
    {{-- <form action="{{ url('/api/articles/' . $article->id . '/comments') }}" method="POST" class="mb-3">
        @csrf
        <div class="mb-2">
            <textarea name="body" class="form-control" rows="3" placeholder="Напишите комментарий..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Отправить</button>
    </form> --}}
@else
    <p><a href="{{ route('login.form') }}">Войдите</a>, чтобы оставить комментарий.</p>
@endauth

@forelse($article->comments as $comment)
    <div class="border rounded p-2 mb-2">
        <p>{{ $comment->body }}</p>
        <small class="text-muted">Автор: {{ $comment->user->name ?? 'Неизвестно' }}, {{ $comment->created_at->diffForHumans() }}</small>
    </div>
@empty
    <p>Комментариев пока нет.</p>
@endforelse
@endsection
