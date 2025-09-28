<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * Класс для модульного тестирования (Unit).
 * Здесь проверяются отдельные компоненты или функции без загрузки приложения.
 */
class ExampleTest extends TestCase
{
    /**
     * Простейший тест, который проверяет истинность утверждения.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true); // Проверка: true === true
    }
}
