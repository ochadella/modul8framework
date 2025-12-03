<?php

use App\Models\ActivityLog;

function logActivity($text)
{
    ActivityLog::create([
        'activity' => $text,
        'user_id' => auth()->id()
    ]);
}
