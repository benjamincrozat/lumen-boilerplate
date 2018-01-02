[![Build Status](https://travis-ci.org/benjamincrozat/lumen-boilerplate.svg?branch=master)](https://travis-ci.org/benjamincrozat/lumen-boilerplate)
[![Latest Stable Version](https://poser.pugx.org/benjamincrozat/lumen-boilerplate/v/stable)](https://packagist.org/packages/benjamincrozat/lumen-boilerplate)
[![Total Downloads](https://poser.pugx.org/benjamincrozat/lumen-boilerplate/downloads)](https://packagist.org/packages/benjamincrozat/lumen-boilerplate)
[![License](https://poser.pugx.org/benjamincrozat/lumen-boilerplate/license)](https://packagist.org/packages/benjamincrozat/lumen-boilerplate)

# Lumen Boilerplate

Opinionated way to start a new Lumen project.

## Summary

* [Why?](#why)
* [Usage](#usage)
* [Testing](#testing)
* [License](#license)

## Why?

Lumen is a very lightweight version of Laravel. Even if Taylor managed to keep a lot of things for real world needs, it's still too light to me. Here is a list of useful packages I added to the project:
- [illuminate/redis](https://github.com/illuminate/redis) and [predis/predis](https://github.com/predis/predis) for Redis based caching and queueing
- [Laravel Tinker](https://github.com/laravel/tinker)
- [codedungeon/phpunit-result-printer](https://github.com/mikeerickson/phpunit-pretty-result-printer) and [nunomaduro/collision](https://github.com/nunomaduro/collision) to make testing even more enjoyable
- [symfony/var-dumper](https://symfony.com/doc/current/components/var_dumper.html) for the `dump()` helper

## Usage

Lumen Boilerplate comes with [Laravel Homestead](https://laravel.com/docs/homestead) and [Vessel](https://vessel.shippingdocker.com/) support out of the box. You are free to run it however you want, though.

If you are familiar with Lumen, let's create a new project via Composer (if not, just [read the documentation](https://lumen.laravel.com/docs)):

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

Psy Shell
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
php vendor/bin/phpunit --filter user_can_read_his_own_data

# You can also do both.
php vendor/bin/phpunit tests/Integration/UserControllerTest.php --filter user_can_read_his_own_data
```

![](https://user-images.githubusercontent.com/3613731/34499897-9b9343ec-f008-11e7-86fb-9f2a7d36591e.png)

## License

[WTFPL](http://www.wtfpl.net/about/)
