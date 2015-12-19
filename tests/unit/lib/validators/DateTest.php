<?php


namespace lib\validators;

use App\Models\User;
use App\Db\Seeds\Models\UserSeeder;

class DateTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected $modelWValidation;

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
        \App\Db\Seeds\DatabaseSeeder::Seed($want_fake = false);
        $this->modelWValidation = new User();
        $this->modelWValidation->assign(
            UserSeeder::ExtraSeeds()[0]
        );

    }

    protected function _after()
    {
        unset($this->modelWValidation);
    }

    public function testValidDates()
    {
        foreach ($this->good_dates as $good) {
            $this->modelWValidation->date_birth = $good;

            $this->tester->assertTrue(
                $this->modelWValidation->save(),
                implode('|', $this->modelWValidation->getMessages())
            );
        }
    }

    public function testWrongDates()
    {
        foreach ($this->bad_dates as $bad) {
            $this->modelWValidation->date_birth = $bad;

            $this->tester->assertFalse($this->modelWValidation->save());
        }
    }
}
