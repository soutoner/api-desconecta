<?php
// Here you can initialize variables that will be available to your tests

// Run migrations before test suite.
exec('phalcon migration run --config=app/config/test-config.php --env=test');
