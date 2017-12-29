[![Build Status](https://travis-ci.org/benjamincrozat/lumen-boilerplate.svg?branch=master)](https://travis-ci.org/benjamincrozat/lumen-boilerplate)
[![Latest Stable Version](https://poser.pugx.org/benjamincrozat/lumen-boilerplate/v/stable)](https://packagist.org/packages/benjamincrozat/lumen-boilerplate)
[![License](https://poser.pugx.org/benjamincrozat/lumen-boilerplate/license)](https://packagist.org/packages/benjamincrozat/lumen-boilerplate)
[![Total Downloads](https://poser.pugx.org/benjamincrozat/lumen-boilerplate/downloads)](https://packagist.org/packages/benjamincrozat/lumen-boilerplate)

# Lumen Boilerplate

Opinionated way to start a new Lumen project.

## Why?

Lumen is a very lightweight version of Laravel. Even if Taylor managed to keep a lot of useful things for real world needs, it's still too light to me. I added some dependencies and boilerplated some useful things.

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

Assuming you're using Laravel Valet, you can hit [http://example.test](http://example.test).

You can even get a token to immediately test if the project is working:

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

{"data":{"id": 1,"name":"Mr. Kamron Toy","email":"fkoelpin@example.org"}}
```

## License

[WTFPL](http://www.wtfpl.net/about/)
