[![Build Status](https://travis-ci.org/benjamincrozat/lumen-boilerplate.svg?branch=master)](https://travis-ci.org/benjamincrozat/lumen-boilerplate)
[![Latest Stable Version](https://poser.pugx.org/benjamincrozat/lumen-boilerplate/v/stable)](https://packagist.org/packages/benjamincrozat/lumen-boilerplate)
[![License](https://poser.pugx.org/benjamincrozat/lumen-boilerplate/license)](https://packagist.org/packages/benjamincrozat/lumen-boilerplate)
[![Total Downloads](https://poser.pugx.org/benjamincrozat/lumen-boilerplate/downloads)](https://packagist.org/packages/benjamincrozat/lumen-boilerplate)

# [Lumen](https://lumen.laravel.com/docs) Boilerplate

Opinionated boilerplate project that fully embrace the Laravel/Lumen philosophy to quick start your next API.

## Why?

[Laravel Lumen](https://lumen.laravel.com/docs) is a fantastic lightweight version of [Laravel](https://laravel.com/docs). Too light most of the time. So, I added things I often need for real world projects without having to switch to the full framework.

## Server requirements

- PHP 7.1

You can [read more about the requirements here](https://lumen.laravel.com/docs/5.5/installation#server-requirements).

## Dependencies

- [Lumen](https://lumen.laravel.com/docs)
- [Laravel Passport](https://laravel.com/docs/passport)
- [dusterio/lumen-passport](https://github.com/dusterio/lumen-passport)

## Usage

You can run Lumen Boilerplate on [Laravel Valet](https://laravel.com/docs/valet), [Laravel Homestead](https://laravel.com/docs/homestead), [Docker](https://www.docker.com/) or whatever you like.

To get started, create a project via Composer to speed things up.

```bash
composer create-project benjamincrozat/lumen-boilerplate example
```

Once you set up your `.env` file, run your migrations:

```bash
php artisan migrate
```

You can even seed some fake data for users:

```bash
php artisan migrate --seed
```

The project can immediately be tested at [http://example.dev](http://example.dev).

The API also works out of the box with a basic token for authentication. First, get it via Tinker:

```bash
php artisan tinker


Psy Shell v0.8.15 (PHP 7.1.10 — cli) by Justin Hileman
>>> App\User::find(1)->api_token
=> "EiLbF31cBwdFHvKd1X2CBKXG7hX9YezFCPqD3dsI7imqwa21HIV3OGUTsxfc"
>>>
```

And make a basic GET request on `http://example.dev/api/v1/user`:

```bash
curl --request GET http://example.dev/api/v1/user?api_token=EiLbF31cBwdFHvKd1X2CBKXG7hX9YezFCPqD3dsI7imqwa21HIV3OGUTsxfc

{"id":1,"name":"Ms. Jeanette Wilkinson V","email":"monserrate.greenholt@example.com","remember_token":"VpAvVVCd5R","created_at":"2017-11-17 21:24:18","updated_at":"2017-11-17 21:24:18"}
```

## License

[WTFPL](http://www.wtfpl.net/about/)
