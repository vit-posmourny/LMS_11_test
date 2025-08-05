<?php

/** convert minutes to hour and minutes */

if (!function_exists('convertMinutesToHours'))
{
    function convertMinutesToHours(int $minutes): string
    {
        $hours = floor($minutes / 60);
        $minutes = $minutes % 60;

        if ($hours == 0)
            return sprintf('%02dmin', $minutes);
        
        return sprintf('%dhr %02dmin', $hours, $minutes);
    }
}
