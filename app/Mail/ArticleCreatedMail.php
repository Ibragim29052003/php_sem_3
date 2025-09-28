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
        return $this->subject('Новая статья: ' . $this->article->title)
                    ->markdown('emails.articles.created')
                    ->with([
                        'title'   => $this->article->title,
                        'body'    => $this->article->body,
                        'author'  => $this->article->user->name,
                        'article' => $this->article, 
                    ]);
    }
    
}
