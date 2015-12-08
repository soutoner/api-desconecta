<?php

namespace Helper;

use \App\Db\Seeds\DatabaseSeeder;


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
    public function _before(\Codeception\TestCase $test) {
        // Populate DB
        DatabaseSeeder::Seed();
    }
}
