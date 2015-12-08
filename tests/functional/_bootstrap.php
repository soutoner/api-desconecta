<?php
// Run migration if necessary
exec('vendor/bin/phalcon.php migration run --config=app/config/test-config.php --env=test');
