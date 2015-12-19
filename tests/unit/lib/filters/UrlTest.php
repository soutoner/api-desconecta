<?php


namespace lib\filters;

use App\Lib\Filters\UrlFilter;
use Phalcon\Filter;

class UrlTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected $filter;

    protected $good_urls = [
        'http://www.google.es',
        'http://google.es',
        'http://localhost:8000',
        'mailto:example@mail.com',
    ];

    protected $bad_urls = [
        'hola',
        'www.google.com',
        '123',
    ];

    protected function _before()
    {
        $this->filter = new Filter();
        $this->filter->add('url', new UrlFilter());
    }

    protected function _after()
    {
        unset($this->filter);
    }

    public function testFilterValid()
    {
        foreach ($this->good_urls as $good) {
            $this->tester->assertEquals($good, $this->filter->sanitize($good, 'url'));
        }
    }

    public function testFilterWrongReturnsFalse()
    {
        foreach ($this->bad_urls as $bad) {
            $this->tester->assertFalse($this->filter->sanitize($bad, 'url'));
        }
    }
}
