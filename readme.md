# Tabunganku API

Tabunganku Official API.

## Quick Start

- Clone this repo or download it's release archive and extract it somewhere
- You may delete `.git` folder if you get this code via `git clone`
- Run `composer update` or `composer install`
- Copy `.env.example` to `.env` for Configure your `.env` file.
- Well Done. 

## A Live PoC

- Run a PHP built in server from your root project:

php -S localhost:8000 -t public/


To authenticate a user, make a `POST` request to `v1/oauth/token` with parameter as mentioned below:

grant_type: tabunganku_password
client_id: 6
client_secret: 3o1FLhkm0lNB9ZEtu6jFMZyhq1BpKtQbDUWmmegw
email: johndoe@example.com
password: johndoe
scope: *

Response:

{
  "success": {
    "token_type": "Bearer",
    "expires_in": "time",
    "access_token": "a_long_access_token_appears_here",
    "refresh_token": "a_long_refresh_token_appears_here"
  }
}



# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/lumen-framework/v/unstable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](http://lumen.laravel.com/docs).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
