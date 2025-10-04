@extends('layout')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Редактировать статью</h1>

    {{-- Форма редактирования через REST API --}}
    <form id="edit-article-form">
        <div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $article->title }}" required>
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Содержание</label>
            <textarea name="body" id="body" class="form-control" rows="5" required>{{ $article->body }}</textarea>
        </div>

        <div class="mb-3">
            <label for="published_at" class="form-label">Дата публикации</label>
            <input type="date" name="published_at" id="published_at" class="form-control" value="{{ $article->published_at }}" required>
        </div>

        <div class="d-flex justify-content-center gap-3">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ url('/api/articles') }}" class="btn btn-secondary">Отмена</a>
        </div>
    </form>
</div>

<script>
document.getElementById('edit-article-form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const data = {
        title: document.getElementById('title').value,
        body: document.getElementById('body').value,
        published_at: document.getElementById('published_at').value
    };

    const token = "{{ session('auth_token') }}"; // токен из сессии

    try {
        const response = await fetch('/api/articles/{{ $article->id }}', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok) {
            alert('Статья успешно обновлена!');
            window.location.href = '/api/articles';
        } else {
            alert(result.message || 'Ошибка при обновлении статьи');
        }
    } catch (err) {
        console.error(err);
        alert('Ошибка сети');
    }
});
</script>
@endsection
