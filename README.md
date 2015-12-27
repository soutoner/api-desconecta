# api-desconecta
API for desconecta project.

[![Build Status](https://travis-ci.com/soutoner/api-desconecta.svg?token=gC1xv7zL8muN3fTRZWiQ&branch=master)](https://travis-ci.com/soutoner/api-desconecta)

### Before all

```
composer install
mysql -uroot -e 'CREATE DATABASE IF NOT EXISTS desconecta_dev;'
mysql -uroot desconecta_dev < app/Db/oauth.sql
```

### Launch development server

`composer install`

`php -S localhost:8000 -t . .htrouter.php`

### Routes workflow 

1. Create collection of routes in `app\collections\vX` (must be inside an `vX` folder!)
2. Add this file to `app\collections\collections.php`
3. Create the necessary controller inside `app\controllers\vX` (must be inside an `vX` folder!)

### log into PHP built-in server console

`error_log(print_r(<whatever>, true));`

### Testing

Enable PHP cUrl extension

`sudo apt-get install php5-curl`

Launch test

`vendor/bin/codecept run`

With code-coverage

`php -d zend_extension=xdebug.so vendor/bin/codecept run --coverage --coverage-html`

Log to debug console

`\Codeception\Util\Debug::debug($this->em);die();`

And run with `--debug` option

### Grumphp

Run checks (triggered also with commits):

`vendor/bin/grumphp run`

Run CBF for dummy fixes:

`vendor/bin/phpcbf app/ tests/`

Run CS to scan problems without the entire Grum- suite checks:

`vendor/bin/phpcs app/ tests/`

### Documentation

Generate docs:

`vendor/bin/swagger app/ -o docs/api-doc.json`

View documentation (not that easy):

Prerequisites:

* NodeJS `https://nodejs.org/en/`
* Npm (comes with NodeJS) 
* Gulp `sudo npm install -g gulp`

```
git clone https://github.com/swagger-api/swagger-ui ~/swagger-ui
cd ~/swagger-ui
npm install
gulp
```

Now open `./dist/index.html` to launch the viewer.

Put `http://localhost:8000/api/v1/docs` in the upper URL and left `api_key` blank.