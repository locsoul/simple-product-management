Simple Product CRUD API 
=======
by Loc Tran

This simple CRUD API uses Symfony framework 3.4

## Requirements
- PHP 7.2
- Composer (https://getcomposer.org/download/)
- PHPUnit (https://phpunit.de)

All the following commands must be executed inside the project root folder.

## Install dependencies
Run `composer install`

## Initialize database and fixtures
- Database init: `php bin\console doctrine:schema:create`
- Fixtures: `php bin\console doctrine:fixture:load`

## Run test server
Run `php bin\console server:run`

The server should be available at http://localhost:8000

## API doc
Browse the API doc at: http://localhost:8000/api/doc

If the API doc page doesn't display correctly, please run `php bin\console  assets:install --symlink`

## Run tests
Assuming `phpunit.phar` is available in `bin` folder or change to appropriate folder.

Run `php bin\phpunit.phar`
