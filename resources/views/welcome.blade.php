@extends('layout')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Latest Articles</h1>

    @if($articles->isEmpty())
        <p class="text-center text-muted">No articles available.</p>
    @else
        <div class="row">
            @foreach($articles as $article)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('images/' . ($article->preview_image ?? 'placeholder_preview.png')) }}" 
                         class="card-img-top" 
                         alt="{{ $article->title }}" 
                         style="height: 200px; object-fit: cover;">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ Str::limit($article->body, 100) }}</p>
                        <p class="text-muted small mb-2">
                            By {{ $article->user->name ?? 'N/A' }} |
                            {{ $article->published_at }} |
                            {{ $article->comments_count ?? 0 }} comments
                        </p>

                        {{-- REST API ссылка на статью --}}
                        <a href="{{ url('/api/articles/' . $article->id) }}" class="btn btn-primary mt-auto btn-sm">
                            Read more →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
