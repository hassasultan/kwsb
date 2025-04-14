<?php

namespace App\Services;

use App\Models\Logs;
use Illuminate\Support\Facades\Auth;

class LogService
{
    /**
     * Create a new log entry.
     *
     * @param string $action
     * @param int $actionId
     * @param string|null $actionDetail
     * @return Logs
     */
    public static function create(string $action, int $actionId, ?string $actionDetail = null): Logs
    {
        return Logs::create([
            'user_id' => Auth::id() ?? 0,
            'action' => $action,
            'action_id' => $actionId,
            'action_detail' => $actionDetail,
        ]);
    }
}
