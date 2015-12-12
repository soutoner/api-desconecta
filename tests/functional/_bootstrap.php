<?php
exec("mysql -u root -e 'CREATE DATABASE IF NOT EXISTS desconecta_test;'");
// Run migration if necessary
exec('vendor/bin/phalcon.php migration run --config=app/config/test-config.php --env=test');
