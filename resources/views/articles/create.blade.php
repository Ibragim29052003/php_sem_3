@extends('layout')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Создать статью</h1>

    {{-- Форма отправки на REST API --}}
    <form id="create-article-form">
        <div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Содержание</label>
            <textarea name="body" id="body" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label for="published_at" class="form-label">Дата публикации</label>
            <input type="date" name="published_at" id="published_at" class="form-control" required>
        </div>

        <div class="d-flex justify-content-center gap-3">
            <button type="submit" class="btn btn-success">Создать</button>
            <a href="{{ url('/api/articles') }}" class="btn btn-secondary">Отмена</a>
        </div>
    </form>
</div>

<script>
document.getElementById('create-article-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const data = {
        title: document.getElementById('title').value,
        body: document.getElementById('body').value,
        published_at: document.getElementById('published_at').value
    };

    const token = "{{ session('auth_token') }}"; // токен из сессии

    try {
        const response = await fetch('/api/articles', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok) {
            alert('Статья успешно создана!');
            window.location.href = '/api/articles/' + result.article.id; // Переходим на просмотр статьи
        } else {
            alert(result.message || 'Ошибка при создании статьи');
        }
    } catch (err) {
        console.error(err);
        alert('Ошибка сети');
    }
});
</script>
@endsection
