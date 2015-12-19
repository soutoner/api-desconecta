<?php


namespace App\Lib\Filters;

class TimestampFilter
{
    /**
     * Validates timestamp with format YYYY-mm-dd h:m:s
     *
     * @param  $value
     * @return bool
     */
    public function filter($value)
    {
        try {
            $dateFilter = new DateFilter();
            $test_arr = explode(' ', $value);
            $validDate = $dateFilter->filter($test_arr[0]);
            $validTime = preg_match("/^([1-2][0-3]|[01]?[1-9]):([0-5]?[0-9]):([0-5][0-9])$/", $test_arr[1]);

            if ($validDate && $validTime) {
                return $value;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}
