# InstaCamp
An Instagram clone app made up by Laravel and MongoDB.

## Project Setup
```
composer install
composer require mongodb/laravel-mongodb
```

## Start server
```
php artisan serve
```

## Models creation
```
php artisan make:model User -m
php artisan make:model Post -m
php artisan make:model Like -m
php artisan make:model Comment -m
```