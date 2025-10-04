<h2>Новая статья создана</h2>

<p>Статья: <strong>{{ $article->title }}</strong></p>
<p>Автор: {{ $article->user->name }}</p>
<p>Дата публикации: {{ $article->published_at }}</p>

<p>Ссылка для просмотра: <a href="{{ $url }}">{{ $url }}</a></p>

