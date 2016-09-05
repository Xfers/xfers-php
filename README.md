# Xfers PHP bindings

You can sign up for a Xfers account at https://xfers.io.

## Requirements

PHP 5.3.3 and later.

## Composer

You can install the bindings via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require xfers/xfers-php
```

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/00-intro.md#autoloading):

```php
require_once('vendor/autoload.php');
```

## Manual Installation

If you do not wish to use Composer, you can download the [latest release](https://github.com/xfers/xfers-php/releases). Then, to use the bindings, include the `init.php` file.

```php
require_once('/path/to/xfers-php/init.php');
```

## Dependencies

The bindings require the following extension in order to work properly:

- [`curl`](https://secure.php.net/manual/en/book.curl.php), although you can use your own non-cURL client if you prefer
- [`json`](https://secure.php.net/manual/en/book.json.php)

If you use Composer, these dependencies should be handled automatically. If you install manually, you'll want to make sure that these extensions are available.

## Getting Started

Simple usage looks like:

```php
\Xfers\Xfers::setApiKey('ENfbme3sus9EjgzXDHoV8W9-MXPj25e4udYst2CGync');
$resp = \Xfers\User::retrieve();
print_r($resp);
```

## Documentation

Please see http://docs.xfers.io/ for up-to-date documentation.