<?php

namespace Shared;

class Helper {

    public static $server_timezone;
    public static $user_timezone;
    public static $server_pattern = 'Y-m-d H:i:s';
    public static $user_pattern = 'Y-m-d H:i';
    public static $timeday_pattern = 'H:i D';
    public static $DST_pattern = 'I';

    public static function extract_values($property, $objects)
    {
        $values = array();
        foreach ($objects as $obj)
            $values[] = $obj->$property;
        return $values;
    }

    public static function server_datetime($server_datetime_string = null)
    {
        if ($server_datetime_string == null)
            return new \DateTime('now', self::$server_timezone);
        return \DateTime::createFromFormat(self::$server_pattern, $server_datetime_string, self::$server_timezone);
    }

    public static function server_datetime_string($server_datetime = null)
    {

        if ($server_datetime == null)
            $server_datetime = new \DateTime('now', self::$server_timezone);
        $server_datetime_string = $server_datetime->format(self::$server_pattern);
        return $server_datetime_string;

    }

    public static function user_datetime_string_to_server_datetime_string($user_datetime_string = null)
    {

        // return current date time
        if ($user_datetime_string == null)
        {
            $server_datetime = new \DateTime('now', self::$server_timezone);
            return $server_datetime->format(self::$server_pattern);
        }

        // create from user string
        $user_datetime = \DateTime::createFromFormat(self::$user_pattern, $user_datetime_string, self::$user_timezone);
        $user_datetime->setTimezone(self::$server_timezone);
        $server_datetime_string = $user_datetime->format(self::$server_pattern);
        return $server_datetime_string;

    }

    public static function server_datetime_string_to_user_datetime_string($server_datetime_string)
    {
        if ($server_datetime_string == null)
            return null;
        $server_datetime = \DateTime::createFromFormat(self::$server_pattern, $server_datetime_string, self::$server_timezone);
        $server_datetime->setTimezone(self::$user_timezone);
        $user_datetime_string = $server_datetime->format(self::$user_pattern);
        return $user_datetime_string;
    }

    public static function timestamp_to_user_datetime_string($timestamp)
    {
        if ($timestamp == null)
            return null;
        $server_datetime = new \DateTime();
        $server_datetime->setTimestamp($timestamp);
        $server_datetime->setTimezone(self::$user_timezone);
        $user_datetime_string = $server_datetime->format(self::$user_pattern);
        return $user_datetime_string;
    }

    public static function DST_hours_offset($datetime, $server_datetime)
    {
        $user_datetime = clone $datetime;
        // convert datetime to user time
        $user_datetime->setTimezone(self::$user_timezone);
        // get user/server dst
        $user_DST = (int)$user_datetime->format(self::$DST_pattern);
        $server_DST = (int)$server_datetime->format(self::$DST_pattern);
        // if same DST, no offset
        if ($user_DST == $server_DST)
            return 0;
        // if currently DST, user non-DST
        if ($server_DST > $user_DST)
            return -1;
        // if current non-DST, user DST
        if ($server_DST < $user_DST)
            return 1;
    }

    public static function server_datetime_to_user_timeday($server_datetime)
    {
        $user_datetime = clone $server_datetime;
        $user_datetime->setTimezone(self::$user_timezone);
        $user_timeday_string = $user_datetime->format(self::$timeday_pattern);
        return $user_timeday_string;
    }

    public static function server_datetime_to_user_datetime($server_datetime)
    {
        $user_datetime = clone $server_datetime;
        $user_datetime->setTimezone(self::$user_timezone);
        return $user_datetime;
    }

    public static function server_datetime_string_to_client_datetime_string($server_datetime_string)
    {
        if ($server_datetime_string == null)
            return null;
        $server_datetime = \DateTime::createFromFormat(self::$server_pattern, $server_datetime_string, self::$server_timezone);
        $server_datetime->setTimezone(self::$user_timezone);
        $client_datetime_string = $server_datetime->format(self::$server_pattern);
        return $client_datetime_string;
    }

    public static function server_datetime_to_client_datetime_string($server_datetime)
    {
        $client_datetime = clone $server_datetime;
        $client_datetime->setTimezone(self::$user_timezone);
        $client_datetime_string = $client_datetime->format(self::$server_pattern);
        return $client_datetime_string;
    }

    public static function server_datetime_to_user_datetime_string($server_datetime, $pattern = null)
    {
        $user_datetime = clone $server_datetime;
        $user_datetime->setTimezone(self::$user_timezone);
        if ($pattern == null)
            $user_datetime_string = $user_datetime->format(self::$user_pattern);
        else
            $user_datetime_string = $user_datetime->format($pattern);
        return $user_datetime_string;
    }

    public static function datetime_add_duration($datetime, $duration)
    {
        $new_datetime = clone $datetime;
        $duration_parts = explode(':', $duration);
        $duration_hours = ltrim($duration_parts[0], '0');
        $duration_minutes = ltrim($duration_parts[1], '0');
        $duration_seconds = ltrim($duration_parts[2], '0');
        $dateinterval_string = 'PT'
            . (($duration_hours != '') ? $duration_hours . 'H' : '')
            . (($duration_minutes != '') ? $duration_minutes . 'M' : '')
            . (($duration_seconds != '') ? $duration_seconds . 'S' : '');
        $new_datetime->add(new DateInterval($dateinterval_string));
        return $new_datetime;

    }

    public static function datetime_add_seconds($datetime, $seconds)
    {
        $new_datetime = clone $datetime;
        $datetinerval = new DateInterval('PT' . $seconds . 'S');
        $new_datetime->add($datetinerval);
        return $new_datetime;

    }

    public static function dateinterval($duration)
    {

        $duration_parts = explode(':', $duration);
        $duration_hours = ltrim($duration_parts[0], '0');
        $duration_minutes = ltrim($duration_parts[1], '0');
        $duration_seconds = (count($duration_parts) > 2) ? ltrim($duration_parts[2], '0') : '';
        $dateinterval_string = 'PT'
            . (($duration_hours != '') ? $duration_hours . 'H' : '')
            . (($duration_minutes != '') ? $duration_minutes . 'M' : '')
            . (($duration_seconds != '') ? $duration_seconds . 'S' : '');
        return new DateInterval($dateinterval_string);

    }

    public static function percentage_seconds($seconds, $percentage)
    {
        // calculate the seconds for this percentage
        return (0.01 * (int)$percentage) * $seconds;
    }

    public static function seconds_duration($seconds)
    {

        // verify
        if ($seconds <= 0)
            return '00:00:00';
        // get number remainder seconds
        $duration_seconds = $seconds % 60;
        $duration_minutes = Math.floor($seconds / 60) % 60;
        $duration_hours = Math.floor($seconds / 60 / 60);
        // return duration string
        return $duration_hours . ':' . $duration_minutes . ':' . $duration_seconds;

    }

    public static function dateinterval_duration($dateinterval)
    {

        // get seconds from dateinterval
        $dateinterval_seconds = self::dateinterval_seconds($dateinterval);
        // verify
        if ($dateinterval_seconds <= 0)
            return '00:00:00';
        // get number remainder seconds
        $seconds = $dateinterval_seconds % 60;
        $minutes = Math.floor($dateinterval_seconds / 60) % 60;
        $hours = Math.floor($dateinterval_seconds / 60 / 60);
        // return duration string
        return $hours . ':' . $minutes . ':' . $seconds;

    }

    public static function dateinterval_seconds($dateinterval)
    {

        // calculate total seconds for this dateinterval
        return ($dateinterval->y * 365 * 24 * 60 * 60) +
            ($dateinterval->y->m * 30 * 24 * 60 * 60) +
            ($dateinterval->y->d * 24 * 60 * 60) +
            ($dateinterval->y->h * 60 * 60) +
            ($dateinterval->y->i * 60) +
            $dateinterval->y->s;

    }

    public static function duration_seconds($duration)
    {
        $duration_parts = explode(':', $duration);
        $duration_hours = ltrim($duration_parts[0], '0');
        $duration_minutes = ltrim($duration_parts[1], '0');
        $duration_seconds = ltrim($duration_parts[2], '0');
        $seconds = (int)$duration_seconds;
        $seconds += (int)$duration_minutes * 60;
        $seconds += (int)$duration_hours * 60 * 60;
        return $seconds;
    }

    public static function datetime_string_time($datetime)
    {
        $datetime_parts = explode(' ', $datetime);
        $time_parts = explode(':', $datetime_parts[1]);
        return self::pad_time($time_parts[0], $time_parts[1]);
    }

    public static function datetime_string_date($datetime)
    {
        $datetime_parts = explode(' ', $datetime);
        return $datetime_parts[0];
    }

    public static function pad_time($hours, $minutes)
    {
        $hours = ($hours == '') ? '00' : $hours;
        $minutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);
        return $hours . ':' . $minutes;
    }

    public static function human_name($name)
    {

        $name_parts = explode('_', $name);
        $name_parts_count = count($name_parts);
        // capitalize each name part
        for ($i = 0; $i < $name_parts_count; $i++)
            $name_parts[$i] = ucfirst($name_parts[$i]);
        // success
        return implode(' ', $name_parts);

    }

    public static function calculate_duration($hours, $minutes, $seconds)
    {
        $minutes += floor($seconds / 60);
        $hours += floor($minutes / 60);
        $minutes = $minutes % 60;
        $seconds = $seconds % 60;
        return str_pad($hours, 2, '0', STR_PAD_LEFT) . ':'
            . str_pad($minutes, 2, '0', STR_PAD_LEFT) . ':'
            . str_pad($seconds, 2, '0', STR_PAD_LEFT);
    }

    public static function normalize_duration($duration)
    {

        // split duration parts
        $duration_parts = explode(':', $duration);
        // get duration parts count
        $duration_parts_count = count($duration_parts);

        $hours = 0;
        $minutes = 0;
        $seconds = 0;
        // normalize duration based on provided input
        if ($duration_parts_count == 3)
        {
            $hours = $duration_parts[0];
            $minutes = $duration_parts[1];
            $seconds = $duration_parts[2];
        }
        else if ($duration_parts_count == 2)
        {
            $minutes = (int)$duration_parts[0];
            $seconds = (int)$duration_parts[1];
        }
        else if ($duration_parts_count == 1)
        {
            $seconds = (int)$duration_parts[0];
        }

        // now recalculate the duration
        return self::calculate_duration($hours, $minutes, $seconds);

    }

    public static function crossed_durations_seconds($durations_count, $transition_seconds, $transition_fade_seconds)
    {
        return ($durations_count - 1) * (($transition_fade_seconds * 2) - $transition_seconds);
    }

    public static function shuffle_assoc(&$list)
    {
        $keys = array_keys($list);
        shuffle($keys);
        $random = array();
        foreach ($keys as $key)
            $random[$key] = $list[$key];
        $list = $random;
    }

    public static function mergesort(&$array, $cmp_function = 'strcmp')
    {
        // Arrays of size < 2 require no action.
        if (count($array) < 2) return;
        // Split the array in half
        $halfway = count($array) / 2;
        $array1 = array_slice($array, 0, $halfway);
        $array2 = array_slice($array, $halfway);
        // Recurse to sort the two halves
        self::mergesort($array1, $cmp_function);
        self::mergesort($array2, $cmp_function);
        // If all of $array1 is <= all of $array2, just append them.
        if (call_user_func($cmp_function, end($array1), $array2[0]) < 1) {
            $array = array_merge($array1, $array2);
            return;
        }
        // Merge the two sorted arrays into a single sorted array
        $array = array();
        $ptr1 = $ptr2 = 0;
        while ($ptr1 < count($array1) && $ptr2 < count($array2)) {
            if (call_user_func($cmp_function, $array1[$ptr1], $array2[$ptr2]) < 1) {
                $array[] = $array1[$ptr1++];
            }
            else {
                $array[] = $array2[$ptr2++];
            }
        }
        // Merge the remainder
        while ($ptr1 < count($array1)) $array[] = $array1[$ptr1++];
        while ($ptr2 < count($array2)) $array[] = $array2[$ptr2++];
        return;
    }

    public static function errors($validation) {
        $out_errors = array();
        foreach ($validation->error() as $field => $error)
            $out_errors[$field] = $error->get_message();
        return $out_errors;
    }

    public static function sanitize_file_title($title, $default_if_empty = 'default', $separator = ' ', $lower_case = false)
    {
        // removes accents
        $title = @iconv('UTF-8', 'us-ascii//TRANSLIT', $title);
        // removes all characters that are not separators, letters, numbers, dots or whitespaces
        $title = preg_replace("/[^ a-zA-Z". preg_quote($separator). "\d\.\s\-\(\)\[\]]/", '', $lower_case ? strtolower($title) : $title);
        // replaces all successive separators into a single one
        $title = preg_replace('!['. preg_quote($separator).'\s]+!u', $separator, $title);
        // trim beginning and ending seperators
        $title = trim($title, $separator);
        // if empty use the default string
        if (empty($title))
            $title = $default_if_empty;
        return $title;
    }

    public static function starts_with($haystack, $needle)
    {
        return $needle === "" || strpos($haystack, $needle) === 0;
    }
    public static function ends_with($haystack, $needle)
    {
        return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
    }

    public static function remove_fakepath($file)
    {
        return str_replace("C:\\fakepath\\", '', $file);
    }

}