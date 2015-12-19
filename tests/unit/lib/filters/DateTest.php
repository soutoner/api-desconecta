<?php


namespace lib\filters;

use App\Lib\Filters\DateFilter;
use Phalcon\Filter;

class DateTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected $filter;

    protected $good_dates = [
        '1994-12-01',
        '2056-08-25',
    ];

    protected $bad_dates = [
        'hola',
        '12-1-1994',
        '01-12-2000',
    ];

    protected function _before()
    {
        $this->filter = new Filter();
        $this->filter->add('date', new DateFilter());
    }

    protected function _after()
    {
        unset($this->filter);
    }

    public function testFilterValid()
    {
        foreach ($this->good_dates as $good) {
            $this->tester->assertEquals($good, $this->filter->sanitize($good, 'date'));
        }
    }

    public function testFilterWrongReturnsFalse()
    {
        foreach ($this->bad_dates as $bad) {
            $this->tester->assertFalse($this->filter->sanitize($bad, 'date'));
        }
    }
}
