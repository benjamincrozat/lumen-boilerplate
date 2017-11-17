[![Build Status](https://travis-ci.org/benjamincrozat/lumen-boilerplate.svg?branch=master)](https://travis-ci.org/benjamincrozat/lumen-boilerplate)
[![Latest Stable Version](https://poser.pugx.org/benjamincrozat/lumen-boilerplate/v/stable)](https://packagist.org/packages/benjamincrozat/lumen-boilerplate)
[![License](https://poser.pugx.org/benjamincrozat/lumen-boilerplate/license)](https://packagist.org/packages/benjamincrozat/lumen-boilerplate)
[![Total Downloads](https://poser.pugx.org/benjamincrozat/lumen-boilerplate/downloads)](https://packagist.org/packages/benjamincrozat/lumen-boilerplate)

# Lumen Boilerplate

Opinionated boilerplate project that fully embraces the Laravel/Lumen philosophy to quick start my next API.

## Why?

Lumen is a fantastic lightweight version of [Laravel](https://laravel.com/docs). Too light most of the time. So, I added things I often need for real world projects without having to switch to the full framework.

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

The API also works out of the box with a basic token for authentication. First, get your token:

```bash
mysql -u root

Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 52
Server version: 5.7.20 Homebrew

Copyright (c) 2000, 2017, Oracle and/or its affiliates. All rights reserved.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> use example; SELECT * FROM users WHERE id = 1;

+----+----------------+----------------------+--------------------------------------------------------------+--------------------------------------------------------------+----------------+---------------------+---------------------+
| id | name           | email                | password                                                     | api_token                                                    | remember_token | created_at          | updated_at          |
+----+----------------+----------------------+--------------------------------------------------------------+--------------------------------------------------------------+----------------+---------------------+---------------------+
|  1 | Mr. Kamron Toy | fkoelpin@example.org | $2y$10$ckbnX6iSFDyC4lHUT.ClwOC59zOkqzbv8sfkTIoNbmRRE.RakRq.K | Z1m3r3Xw6ejiSZwKwJxTXQCdcGThp78Crs4HoviKUxoGNkPNN7rbo8IliU5u | U6udLlAqAx     | 2017-11-17 22:46:11 | 2017-11-17 22:46:11 |
+----+----------------+----------------------+--------------------------------------------------------------+--------------------------------------------------------------+----------------+---------------------+---------------------+
1 row in set (0,00 sec)
```

And make a basic GET request on `http://example.dev/api/v1/user`:

```bash
curl --request GET http://example.dev/api/v1/user?api_token=Z1m3r3Xw6ejiSZwKwJxTXQCdcGThp78Crs4HoviKUxoGNkPNN7rbo8IliU5u

{"data":{"name":"Mr. Kamron Toy","email":"fkoelpin@example.org"}}
```

## License

[WTFPL](http://www.wtfpl.net/about/)
