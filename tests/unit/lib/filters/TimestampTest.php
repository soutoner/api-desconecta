<?php


namespace lib\filters;

use App\Lib\Filters\TimestampFilter;
use Phalcon\Filter;

class TimestampTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected $filter;

    protected $good_timestamps = [
        '2000-01-01 16:34:12',
        '1900-02-21 01:00:00',
    ];

    protected $bad_timestamps = [
        'hola',
        '1994-11-11',
        '16:34:12',
        '2000-01-01 16:34:1',
        '1900-02-21 00:00:00',
    ];

    protected function _before()
    {
        $this->filter = new Filter();
        $this->filter->add('timestamp', new TimestampFilter());
    }

    protected function _after()
    {
        unset($this->filter);
    }

    public function testFilterValid()
    {
        foreach ($this->good_timestamps as $good) {
            $this->tester->assertEquals($good, $this->filter->sanitize($good, 'timestamp'));
        }
    }

    public function testFilterWrongReturnsFalse()
    {
        foreach ($this->bad_timestamps as $bad) {
            $this->tester->assertFalse($this->filter->sanitize($bad, 'timestamp'));
        }
    }
}
