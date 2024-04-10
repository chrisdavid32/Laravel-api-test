# LARAVEL API TEST
The project version is laravel 10.10
## Getting started
## Requirements

- PHP >= 8.1

## Installation
Clone the repository
```
    git clone https://github.com/chrisdavid32/Laravel-api-test.git 
```

Switch to the project directory
```
    cd Laravel-api-test
```
install dependency
```
    composer install
```
Copy the example env file and make the required configuration changes in the .env file

```
    cp .env.example .env
```
Generate a new application key

```
    php artisan key:generate
```
Run the database migrations (**Set the database connection in .env and create a new database before migrating**)
```
    php artisan migrate
```
Start the local development server
```
    php artisan serve
```
Here is the link to the Published POSTMAN documentation

https://documenter.getpostman.com/view/13109130/2sA3BgAaip

