<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Класс для функционального тестирования (Feature).
 * Здесь проверяется поведение приложения целиком, включая маршруты, контроллеры и middleware.
 */
class ExampleTest extends TestCase
{
    /**
     * Простейший тест, проверяющий успешный HTTP-ответ для главной страницы.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        // Отправляем GET-запрос на маршрут "/"
        $response = $this->get('/');

        // Проверяем, что код ответа HTTP равен 200
        $response->assertStatus(200);
    }
}
