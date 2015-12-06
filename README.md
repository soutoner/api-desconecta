# api-desconecta
API for desconecta project.

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

### TODO

* Check existence of resource before deleting or updating