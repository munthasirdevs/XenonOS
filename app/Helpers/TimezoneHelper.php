<?php

use Carbon\Carbon;

if (!function_exists('valid_timezone')) {
    function valid_timezone($tz) {
        $valid = in_array($tz, DateTimeZone::listIdentifiers(), true);
        return $valid ? $tz : 'Asia/Dhaka';
    }
}

if (!function_exists('user_timezone')) {
    function user_timezone($timezone = null) {
        $tz = $timezone ?? auth()->user()?->timezone ?? 'Asia/Dhaka';
        return valid_timezone($tz);
    }
}

if (!function_exists('format_user_time')) {
    function format_user_time($date, $format = 'M d, Y H:i') {
        if (!$date) return 'N/A';

        $tz = valid_timezone(auth()->user()?->timezone ?? 'Asia/Dhaka');

        $carbon = Carbon::parse($date)->timezone($tz);
        return $carbon->format($format);
    }
}

if (!function_exists('user_time_ago')) {
    function user_time_ago($date) {
        if (!$date) return 'N/A';

        $tz = valid_timezone(auth()->user()?->timezone ?? 'Asia/Dhaka');

        return Carbon::parse($date)->timezone($tz)->diffForHumans();
    }
}
