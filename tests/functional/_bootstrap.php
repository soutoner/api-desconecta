<?php

putenv("APP_ENV=test");
exec("mysql -u root -e 'CREATE DATABASE IF NOT EXISTS desconecta_test;'");
// Run migration if necessary
exec('vendor/bin/phalcon.php migration run --env=test');
exec('mysql -u root desconecta_test < app/Db/oauth.sql');
