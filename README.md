[![Build Status](https://travis-ci.org/benjamincrozat/lumen-boilerplate.svg?branch=master)](https://travis-ci.org/benjamincrozat/lumen-boilerplate)
[![Latest Stable Version](https://poser.pugx.org/benjamincrozat/lumen-boilerplate/v/stable)](https://packagist.org/packages/benjamincrozat/lumen-boilerplate)
[![Total Downloads](https://poser.pugx.org/benjamincrozat/lumen-boilerplate/downloads)](https://packagist.org/packages/benjamincrozat/lumen-boilerplate)
[![License](https://poser.pugx.org/benjamincrozat/lumen-boilerplate/license)](https://packagist.org/packages/benjamincrozat/lumen-boilerplate)

# Lumen Boilerplate

Opinionated way to start a new Lumen project.

## Summary

* [Why?](#why)
* [Usage](#usage)
* [Sample code](#sample-code)
* [Testing](#testing)
* [License](#license)

## Why?

Lumen is a very lightweight version of Laravel. Even if Taylor managed to keep a lot of things for real world needs, it's still too light to me. Here is a list of useful packages I added to the project:
- [barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper) to help you out digging Lumen's source
- [benjamincrozat/lumen-swagger](https://github.com/benjamincrozat/lumen-swagger) to generate a `swagger.json` file from annotations
- [Clockwork](https://underground.works/clockwork/) for easy debugging
- [codedungeon/phpunit-result-printer](https://github.com/mikeerickson/phpunit-pretty-result-printer) and [nunomaduro/collision](https://github.com/nunomaduro/collision) to make testing even more enjoyable
- [illuminate/redis](https://github.com/illuminate/redis) and [predis/predis](https://github.com/predis/predis) for Redis based caching and queueing (I recommand installing the native PHP extension instead of predis/predis, though)
- [illuminate/routing](https://github.com/illuminate/routing) for requests throttling. Don't worry, only the middleware is loaded.
- [laravel/tinker](https://github.com/laravel/tinker)
- [spatie/laravel-cors](https://github.com/spatie/laravel-cors)
- [symfony/var-dumper](https://symfony.com/doc/current/components/var_dumper.html) for the `dump()` helper
- [webpatser/laravel-uuid](https://github.com/webpatser/laravel-uuid), supported by default on User and Post models
- Requests throttling from Laravel

## Usage

Lumen Boilerplate comes with [Laravel Homestead](https://laravel.com/docs/homestead) and [Vessel](https://vessel.shippingdocker.com/) support out of the box, but you are free to run it in whatever environment you wish.

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

## Sample code

Lumen Boilerplate integrates basic CRUD for blog posts, integration tests and sample files that can be quickly duplicated.

## Testing

It's *probably* a good idea to test your code. Lumen Boilerplate comes with tests to show you the way.

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

Here are some of my thoughts on testing:
- Unit Tests don't ensure a working app. Good Integration Tests make your app a hell lot more reliable;
- Use Facades inside your tests to make mocking smoother;
- Be as exhaustive as possible.

![](https://user-images.githubusercontent.com/3613731/34539046-4eeb8c30-f0cf-11e7-9819-f6dce59a2d96.png)

## License

[MIT](http://opensource.org/licenses/MIT)
