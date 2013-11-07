<?php

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
            return new DateTime('now', self::$server_timezone);
        return DateTime::createFromFormat(self::$server_pattern, $server_datetime_string, self::$server_timezone);
    }

    public static function server_datetime_string($server_datetime = null)
    {

        if ($server_datetime == null)
            $server_datetime = new DateTime('now', self::$server_timezone);
        $server_datetime_string = $server_datetime->format(self::$server_pattern);
        return $server_datetime_string;

    }

    public static function user_datetime_string_to_server_datetime_string($user_datetime_string = null)
    {

        // return current date time
        if ($user_datetime_string == null)
        {
            $server_datetime = new DateTime('now', self::$server_timezone);
            return $server_datetime->format(self::$server_pattern);
        }

        // create from user string
        $user_datetime = DateTime::createFromFormat(self::$user_pattern, $user_datetime_string, self::$user_timezone);
        $user_datetime->setTimezone(self::$server_timezone);
        $server_datetime_string = $user_datetime->format(self::$server_pattern);
        return $server_datetime_string;

    }

    public static function server_datetime_string_to_user_datetime_string($server_datetime_string)
    {
        if ($server_datetime_string == null)
            return null;
        $server_datetime = DateTime::createFromFormat(self::$server_pattern, $server_datetime_string, self::$server_timezone);
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
        $server_datetime = DateTime::createFromFormat(self::$server_pattern, $server_datetime_string, self::$server_timezone);
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

    public static function normalized_duration($duration)
    {

        $duration_parts = explode(':', $duration);
        if (count($duration_parts) == 3)
        {
            $hours = $duration_parts[0];
            $minutes = $duration_parts[1];
            $seconds = $duration_parts[2];
            return str_pad($hours, 2, '0', STR_PAD_LEFT) . ':'
                . str_pad($minutes, 2, '0', STR_PAD_LEFT) . ':'
                . str_pad($seconds, 2, '0', STR_PAD_LEFT);
        }
        else
        {
            $minutes = (int)$duration_parts[0];
            $seconds = (int)$duration_parts[1];
            return '00:'
                . str_pad($minutes, 2, '0', STR_PAD_LEFT) . ':'
                . str_pad($seconds, 2, '0', STR_PAD_LEFT);
        }

    }

    public static function crossed_durations_seconds($durations_count, $transition_seconds, $transition_fade_seconds)
    {
        return ($durations_count - 1) * (($transition_fade_seconds * 2) - $transition_seconds);
    }

}