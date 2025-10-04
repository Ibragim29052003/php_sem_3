<?php

namespace App\Mail;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ArticleCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function build()
{
    // Ссылка на просмотр статьи через API
    $articleUrl = url('/api/articles/' . $this->article->id);

    return $this->subject('Создана новая статья')
                ->view('emails.articles.created')
                ->with([
                    'article' => $this->article,
                    'url' => $articleUrl,
                ]);
}
}
