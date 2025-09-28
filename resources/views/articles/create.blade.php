@extends('layout')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Создать статью</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Содержание</label>
            <textarea name="body" id="body" class="form-control" rows="5" required>{{ old('body') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="published_at" class="form-label">Дата публикации</label>
            <input type="date" name="published_at" id="published_at" class="form-control" value="{{ old('published_at') }}" required>
        </div>

        <div class="d-flex justify-content-center gap-3">
            <button type="submit" class="btn btn-success">Создать</button>
            <a href="{{ route('articles.index') }}" class="btn btn-secondary">Отмена</a>
        </div>
    </form>
</div>
@endsection
