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
* [Packages suggestions](#packages-suggestions)
* [License](#license)

## Why?

Lumen is a very lightweight version of Laravel. Even if Taylor managed to keep a lot of useful things for real world needs, it's still too light to me. I added a little bit of dependencies and boilerplated useful things.

## Usage

Lumen Boilerplate comes with [Laravel Valet](https://laravel.com/docs/valet), [Laravel Homestead](https://laravel.com/docs/homestead) and [Vessel](https://vessel.shippingdocker.com/) support out of the box.

If you're familiar with Lumen, let's create a new project via Composer (if not, just [read the documentation](https://lumen.laravel.com/docs)):

```bash
composer create-project benjamincrozat/lumen-boilerplate example
```

Set up your `.env` file and run your migrations. You can even seed some fake data for users:

```bash
php artisan migrate --seed
```

Laravel Tinker is part of this project. You can use it to quickly get an API token...

```bash
php artisan tinker

Psy Shell v0.8.17 (PHP 7.2.0 — cli) by Justin Hileman
>>> App\User::first()->api_token
=> "fIj2rTFTWbB2UO2ZrVhEdHhLMV1XNLgHGzIMZk5FlRqww4tP2y0yyWCktTfg"
```

... and send your first GET request to `http://example.test/api/v1/user`:

```bash
curl --request GET http://example.test/api/v1/user?api_token=fIj2rTFTWbB2UO2ZrVhEdHhLMV1XNLgHGzIMZk5FlRqww4tP2y0yyWCktTfg

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

## Packages suggestions

* [spatie/laravel-permission](https://github.com/spatie/laravel-permission) to add permissions and roles support to your API. This package supports Lumen out of the box. In fact, I did [the PR](https://github.com/spatie/laravel-permission/pull/568). :)

## License

[WTFPL](http://www.wtfpl.net/about/)
