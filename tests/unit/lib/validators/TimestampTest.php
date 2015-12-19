<?php


namespace lib\validators;

use App\Models\Event;
use App\Db\Seeds\Models\EventSeeder;

class TimestampTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected $modelWValidation;

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
        \App\Db\Seeds\DatabaseSeeder::Seed($want_fake = false);
        $this->modelWValidation = new Event();
        $this->modelWValidation->assign(
            EventSeeder::ExtraSeeds()[0]
        );

    }

    protected function _after()
    {
        unset($this->modelWValidation);
    }

    public function testValidTimestamps()
    {
        foreach ($this->good_timestamps as $good) {
            $this->modelWValidation->start_date = $good;

            $this->tester->assertTrue(
                $this->modelWValidation->save(),
                implode('|', $this->modelWValidation->getMessages())
            );
        }
    }

    public function testWrongTimestamps()
    {
        foreach ($this->bad_timestamps as $bad) {
            $this->modelWValidation->start_date = $bad;

            $this->tester->assertFalse($this->modelWValidation->save());
        }
    }
}
