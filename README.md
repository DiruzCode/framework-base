# Instalación #


### Especificaciones ###

* PHP 7.2
* MYSQL (charset => utf8mb4 - collation => utf8mb4_spanish2_ci)
* Laravel 5.7.* (current 5.6.3)
* Webpack ( [laravel-mix](https://laravel.com/docs/5.7/mix)
* NPM
* [Libreria de permisos](https://github.com/spatie/laravel-permission)

### Guia de instalación ###

* cd framework_base
* npm install
* composer install
* cp .env.example .env
* php artisan key:generate

* Create manual DB and configure in .env

* php artisan migrate --seed
* npm run dev
* php artisan serve
* user = admin@admin.cl
* password = admin1234

* [url http://127.0.0.1:8000](http://127.0.0.1:8000)


### Guia de redis ###
* [url](https://redis.io/topics/quickstart)
