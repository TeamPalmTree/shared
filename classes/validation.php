<?php

class Validation extends \Fuel\Core\Validation {

    protected static $days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

    public function _validation_non_zero_duration($val)
    {
        return $val != '00:00:00';
    }

    public function _validation_day_checked($val)
    {
        if (!is_array($val))
            return false;

        if (count($val) == 0)
            return false;

        foreach (self::$days as $day)
        {
            if (isset($val[$day]) && $val[$day])
                return true;
        }

        return false;
    }

    public function _validation_musical_key($val)
    {
        return !is_null(MixingWheel::get_key($val));
    }

    public function _validation_total_percentage($val)
    {
        return ($val == '0') or ($val == '100');
    }

} 