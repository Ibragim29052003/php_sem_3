<?php

namespace App\Http\Middleware;

// Middleware блокирует все запросы при включенном режиме обслуживания.

// URI в $except остаются доступными, например, для админов или системного мониторинга.

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * Список URI, доступных во время режима обслуживания.
     */
    protected $except = [
        //
    ];
}
