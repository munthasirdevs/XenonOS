<?php

use Carbon\Carbon;

if (!function_exists('user_timezone')) {
    function user_timezone($timezone = null) {
        $tz = $timezone ?? auth()->user()?->timezone ?? 'London';
        
        $offsets = [
            'London' => 0,
            'NewYork' => -5,
            'Paris' => 1,
            'Japan' => 9,
            'Beijing' => 8,
            'India' => 5.5,
            'Bangladesh' => 6,
        ];
        
        return $offsets[$tz] ?? 0;
    }
}

if (!function_exists('format_user_time')) {
    function format_user_time($date, $format = 'M d, Y H:i') {
        if (!$date) return 'N/A';
        
        $tz = auth()->user()?->timezone ?? 'London';
        $offset = user_timezone($tz);
        
        $carbon = Carbon::parse($date)->addHours($offset);
        return $carbon->format($format);
    }
}

if (!function_exists('user_time_ago')) {
    function user_time_ago($date) {
        if (!$date) return 'N/A';
        
        $tz = auth()->user()?->timezone ?? 'London';
        $offset = user_timezone($tz);
        
        return Carbon::parse($date)->addHours($offset)->diffForHumans();
    }
}
