# SeamLabs #
a fleet-management system (bus-booking system) using the latest version of the Laravel Framework.

## Requirements ##


Or to run the project locally:
- PHP 8.1+
- Supported databases:
  - MySQL 5.7+


## Local environment Installation ##

1. Install the laravel dependencies
```bash
composer install
```
2. Execute the migrations
```bash
php artisan migrate
```
3. Run the database seeder to generate the restaurant menu items data.
```bash
php artisan db:seed
```
4. Start the laravel app server
```bash
php artisan serve
```

## Urls:

- API swagger documentation: /api/documentation.(It contains both the problems and the restaurant APIs)

## How the restaurant order API works:

__To create a new order:__
1. Check the IDs of the menu items through the GET API /api/items

2. Create a new order(whatever its type) while adding the IDs of the desired menu items to the items[] array in the body.
