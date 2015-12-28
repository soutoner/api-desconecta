<?php

namespace Helper;

use App\Db\Seeds\DatabaseSeeder;

class Functional extends \Codeception\Module
{
    /**
     * All public methods declared in helper class will be available in $I.
     */

    /**
     * Before each test.
     *
     * @param \Codeception\TestCase $test
     */
    public function _before(\Codeception\TestCase $test)
    {
        // Populate DB
        DatabaseSeeder::Seed(false);
    }

    public function seeExceptionThrown($exception, $function)
    {
        $failed = true;
        try {
            $function();
            $failed = false;
        } catch (\Exception $e) {
            $this->assertEquals($exception, get_class($e));
        }
        $this->assertTrue($failed);
    }

    public function dontSeeExceptionThrown($exception, $function)
    {
        try {
            $function();
        } catch (\Exception $e) {
            $this->assertNotEquals($exception, get_class($e));
        }
    }
}
