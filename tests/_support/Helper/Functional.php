<?php

namespace Helper;


// here you can define custom actions
// all public methods declared in helper class will be available in $I
class Functional extends \Codeception\Module
{
    /**
     * Before each test.
     *
     * @param \Codeception\TestCase $test
     */
    public function _before(\Codeception\TestCase $test) {
        // Populate DB
        include APP_PATH . '/tests/_data/DatabaseSeeder.php';
    }
}
