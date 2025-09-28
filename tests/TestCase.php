<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * Базовый класс для всех тестов приложения.
 * Наследует функционал Laravel TestCase и использует трейт CreatesApplication.
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication; // Позволяет создавать экземпляр приложения для тестов
}
