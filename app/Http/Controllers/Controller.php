<?php

namespace App\Http\Controllers;

// Базовый контроллер, от которого будут наследоваться все остальные контроллеры приложения.

// Подключенные трейты дают стандартные возможности для авторизации и валидации.

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    // Трейты:
    // AuthorizesRequests → для проверки прав доступа
    // ValidatesRequests → для валидации входных данных
    use AuthorizesRequests, ValidatesRequests;
}
