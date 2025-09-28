@extends('layout')

@section('title', 'Редактировать комментарий')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Редактировать комментарий</h1>

    <form action="{{ route('comments.update', $comment) }}" method="POST">
        @csrf
        @method('PUT')
        <textarea name="body" class="form-control mb-3" rows="5" required>{{ old('body', $comment->body) }}</textarea>
        <div class="d-flex gap-3 justify-content-center">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('articles.show', $comment->article_id) }}" class="btn btn-secondary">Отмена</a>
        </div>
    </form>
</div>
@endsection
