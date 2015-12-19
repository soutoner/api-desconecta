<?php


namespace App\Lib\Filters;

class UrlFilter
{
    /**
     * Validates Urls http://php.net/manual/es/filter.filters.validate.php.
     *
     * @param  $value
     * @return mixed
     */
    public function filter($value)
    {
        return filter_var($value, FILTER_VALIDATE_URL);
    }
}
