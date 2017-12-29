[![Build Status](https://travis-ci.org/benjamincrozat/lumen-boilerplate.svg?branch=master)](https://travis-ci.org/benjamincrozat/lumen-boilerplate)
[![Latest Stable Version](https://poser.pugx.org/benjamincrozat/lumen-boilerplate/v/stable)](https://packagist.org/packages/benjamincrozat/lumen-boilerplate)
[![License](https://poser.pugx.org/benjamincrozat/lumen-boilerplate/license)](https://packagist.org/packages/benjamincrozat/lumen-boilerplate)
[![Total Downloads](https://poser.pugx.org/benjamincrozat/lumen-boilerplate/downloads)](https://packagist.org/packages/benjamincrozat/lumen-boilerplate)

# Lumen Boilerplate

Opinionated way to start a new Lumen project.

## Summary

* [Why?](#why)
* [Usage](#usage)
* [Testing](#testing)
* [License](#license)

## Why?

Lumen is a very lightweight version of Laravel. Even if Taylor managed to keep a lot of useful things for real world needs, it's still too light to me. I added a little bit of dependencies and boilerplated useful things.

## Usage

You can run Lumen Boilerplate on [Laravel Valet](https://laravel.com/docs/valet), [Laravel Homestead](https://laravel.com/docs/homestead), [Docker](https://vessel.shippingdocker.com/) or whatever you like.

To get started, create a new project via Composer:

```bash
composer create-project benjamincrozat/lumen-boilerplate example
```

Set up your `.env` file and run your migrations. You can even seed some fake data for users:

```bash
php artisan migrate --seed
```

You can get a token to test if the project is working properly:

```bash
mysql -u root

mysql> USE example; SELECT api_token FROM users WHERE id = 1;

+--------------------------------------------------------------+
| api_token                                                    |
+--------------------------------------------------------------+
| Z1m3r3Xw6ejiSZwKwJxTXQCdcGThp78Crs4HoviKUxoGNkPNN7rbo8IliU5u |
+--------------------------------------------------------------+
```

Send a GET request to `http://example.test/api/v1/user`:

```bash
curl --request GET http://example.test/api/v1/user?api_token=Z1m3r3Xw6ejiSZwKwJxTXQCdcGThp78Crs4HoviKUxoGNkPNN7rbo8IliU5u

{
    "data": {
        "id": 1,
        "name": "Mr. Kamron Toy",
        "email": "fkoelpin@example.org"
    }
}
```

## Testing

It's probably a good idea to test your code. Lumen Boilerplate comes with two passing tests to show you the way.

```bash
# Run all tests.
php vendor/bin/phpunit

# Run only unit tests.
php vendor/bin/phpunit --testsuite Unit

# Run only integration tests.
php vendor/bin/phpunit --testsuite Integration

# Run only tests within a given file.
php vendor/bin/phpunit tests/Integration/UserControllerTest.php

# Run only a given test method.
php vendor/bin/phpunit --filter authenticated_user_can_read_his_own_data

# You can also do both.
php vendor/bin/phpunit tests/Integration/UserControllerTest.php --filter authenticated_user_can_read_his_own_data
```

## License

[WTFPL](http://www.wtfpl.net/about/)
