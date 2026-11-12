<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLogger
{
    /**
     * Log a system or user activity.
     */
    public static function log(string $event, string $description, ?array $properties = null, ?User $user = null): ActivityLog
    {
        $userId = $user ? $user->id : (Auth::check() ? Auth::id() : null);

        return ActivityLog::create([
            'user_id' => $userId,
            'event' => $event,
            'description' => $description,
            'ip_address' => Request::ip() ?? '127.0.0.1',
            'user_agent' => Request::userAgent() ? substr(Request::userAgent(), 0, 500) : null,
            'properties' => $properties,
            'created_at' => now(),
        ]);
    }
}
