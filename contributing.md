Getting Started
---------------

### Prerequisites

You're going to need:

- **PHP 7.0**
- [**Phalcon 3.3**](https://phalconphp.com/)
- **Apache** or **Nginx**

### Getting Set Up

Install required dependencies via `composer install` and set server document root to `public` directory. Copy `.env.default` file to `.env` and overwrite your environment-specific configuration.

Tests can be executed using the `composer run-script tests` command.

### Migrations

Database migrations and seeds are implemented using [Phinx](https://github.com/cakephp/phinx) library. Discover the possibilities of the library on the [documentation](https://book.cakephp.org/3.0/en/phinx.html) or by browsing the results of the `vendor/bin/phinx list` command.
