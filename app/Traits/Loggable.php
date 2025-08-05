<?php

namespace App\Traits;

use App\Models\Logs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

trait Loggable
{
    /**
     * Log an action
     *
     * @param string $action
     * @param int|null $actionId
     * @param string|null $actionDetail
     * @return void
     */
    public static function logAction($action, $actionId = null, $actionDetail = null)
    {
        try {
            Logs::create([
                'user_id' => Auth::id(),
                'action' => $action,
                'action_id' => $actionId,
                'action_detail' => $actionDetail,
            ]);
        } catch (\Exception $e) {
            // Log error but don't break the application
            Log::error('Failed to log action: ' . $e->getMessage());
        }
    }

    /**
     * Log a complaint action
     *
     * @param int $complaintId
     * @param string $action
     * @param string|null $detail
     * @return void
     */
    public static function logComplaintAction($complaintId, $action, $detail = null)
    {
        self::logAction('Complaint', $complaintId, $detail ?: "Complaint {$action}");
    }

    /**
     * Log a user action
     *
     * @param int $userId
     * @param string $action
     * @param string|null $detail
     * @return void
     */
    public static function logUserAction($userId, $action, $detail = null)
    {
        self::logAction('User', $userId, $detail ?: "User {$action}");
    }

    /**
     * Log a system action
     *
     * @param string $action
     * @param string|null $detail
     * @return void
     */
    public static function logSystemAction($action, $detail = null)
    {
        self::logAction('System', null, $detail ?: "System {$action}");
    }

    /**
     * Log login action
     *
     * @param string|null $detail
     * @return void
     */
    public static function logLogin($detail = null)
    {
        self::logAction('Login', Auth::id(), $detail ?: 'User logged in');
    }

    /**
     * Log logout action
     *
     * @param string|null $detail
     * @return void
     */
    public static function logLogout($detail = null)
    {
        self::logAction('Logout', Auth::id(), $detail ?: 'User logged out');
    }
}
