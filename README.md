# container

 [![Build Status](https://travis-ci.org/seeren/container.svg?branch=master)](https://travis-ci.org/seeren/container) [![Coverage Status](https://coveralls.io/repos/github/seeren/container/badge.svg?branch=master)](https://coveralls.io/github/seeren/container?branch=master) [![Packagist](https://img.shields.io/packagist/dt/seeren/container.svg)](https://packagist.org/packages/seeren/container/stats) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/4a0463fb5a084be5bda68e4e36d7c7ac)](https://www.codacy.com/app/seeren/container?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=seeren/container&amp;utm_campaign=Badge_Grade) [![Packagist](https://img.shields.io/packagist/v/seeren/container.svg)](https://packagist.org/packages/seeren/container#) [![Packagist](https://img.shields.io/packagist/l/seeren/log.svg)](LICENSE)

**Configure dependency injection**

> This package contain implementations of the [PSR-11 container interfaces](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-11-container.md)

## Features

* Manage objects creation and persistence.
* Configure dependency injection.

## Installation

Require this package with [composer](https://getcomposer.org/)

```
composer require seeren/container dev-master
```

## Usage

#### `Seeren\Container\Container`

The container can resolve an instance for a class name.
```php
$foo = $container->get(Foo::class);
```

Injections can be configured using class name
```php
class Foo {
    public function __construct(Bar $bar){}
}
```

Injection can be configured using @param
```php
class Foo {
   /**
    * @param Bar $bar
    */
    public function __construct($bar){}
}
```

#### `Seeren\Container\Service\ServiceProvider`

Object construction can be centralised in service providers.
```php
class Provider extends ServiceProvider
{
    public function __construct()
    {
        parent::__construct([
            "foo" => function ($c) { return new Foo($c->get("bar")); },
            "bar" => function ($c) {  return new Bar; },
        ]);
    }
}
```

Container can register providers.
```php
$foo = $container->register(new Provider)->get("foo");
```

## Construction

Using services only.
```php
$container = new CacheContainer;
```

Using class name and services.
```php
$container = new Container(new TypeHintingResolver, new CacheContainer);
```

Using @param and services.
```php
$container = new Container(new DocumentationResolver, new CacheContainer);
```

## Run Tests

Run [phpunit](https://phpunit.de/) with [Xdebug](https://xdebug.org/) enable and [OPcache](http://php.net/manual/fr/book.opcache.php) disable.

```
./vendor/bin/phpunit
```

## Run Coverage

Run [coveralls](https://coveralls.io/).

```
./vendor/bin/coveralls -v
```

## License

This project is licensed under the **MIT License** - see the [license](LICENSE) file for details.
