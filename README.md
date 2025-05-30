# InstaCamp
An Instagram clone app made up by Laravel and MongoDB.

## Project Setup
```
composer global require laravel installer
laravel new instacamp
composer install
composer require mongodb/laravel-mongodb
```

## Start Server
```
php artisan serve
```

## Models Creation
```
php artisan make:model User -m
php artisan make:model Post -m
php artisan make:model Like -m
php artisan make:model Comment -m
```

## Laravel UI Installation
```
composer require laravel/ui
```

## Authentication UI Scaffolding
```
php artisan ui bootstrap --auth
```

## Building Controllers
```
php artisan make:controller PostController --resource
php artisan make:controller ProfileController --resource
php artisan make:controller CommentController --resource
php artisan make:controller LikeController --resource
```

## Public Storage Link Creation
```
php artisan storage:link
```

_Happy Coding_ 🤩