<?php

use Carbon\Carbon;

if (!function_exists('user_timezone')) {
    function user_timezone($timezone = null) {
        $tz = $timezone ?? auth()->user()?->timezone ?? 'Europe/London';
        return $tz;
    }
}

if (!function_exists('format_user_time')) {
    function format_user_time($date, $format = 'M d, Y H:i') {
        if (!$date) return 'N/A';
        
        $tz = auth()->user()?->timezone ?? 'Europe/London';
        
        $carbon = Carbon::parse($date)->timezone($tz);
        return $carbon->format($format);
    }
}

if (!function_exists('user_time_ago')) {
    function user_time_ago($date) {
        if (!$date) return 'N/A';
        
        $tz = auth()->user()?->timezone ?? 'Europe/London';
        
        return Carbon::parse($date)->timezone($tz)->diffForHumans();
    }
}
