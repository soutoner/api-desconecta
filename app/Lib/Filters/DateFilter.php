<?php


namespace App\Lib\Filters;

class DateFilter
{
    /**
     * Validates dates with format YYYY-mm-dd
     *
     * @param  $value
     * @return bool
     */
    public function filter($value)
    {
        try {
            $test_arr = explode('-', $value);
            if (checkdate($test_arr[1], $test_arr[2], $test_arr[1])) {
                return $value;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}
