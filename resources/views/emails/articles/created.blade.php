@component('mail::message')
# Новая статья опубликована!

**Заголовок:** {{ $title }}

**Автор:** {{ $author }}

{{ $body }}

@component('mail::button', ['url' => route('articles.show', $article)])
Читать статью
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
