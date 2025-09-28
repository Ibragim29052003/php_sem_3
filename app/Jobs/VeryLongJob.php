<?php

namespace App\Jobs;

use App\Models\Article;
use App\Mail\ArticleCreatedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VeryLongJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $article;

    /**
     * Create a new job instance.
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Логируем начало
        Log::info('Запуск VeryLongJob для статьи ID: ' . $this->article->id);

        // Сохраняем в историю job
        DB::table('job_history')->insert([
            'job_name'    => self::class,
            'payload'     => json_encode(['article_id' => $this->article->id, 'title' => $this->article->title]),
            'executed_at' => now(),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        // Отправка письма
        Mail::to(config('mail.moderator'))->send(new ArticleCreatedMail($this->article));

        // Логируем успешное завершение
        Log::info('VeryLongJob успешно выполнен для статьи ID: ' . $this->article->id);
    }
}
