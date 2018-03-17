# container

 [![Build Status](https://travis-ci.org/seeren/container.svg?branch=master)](https://travis-ci.org/seeren/container) [![Coverage Status](https://coveralls.io/repos/github/seeren/container/badge.svg?branch=master)](https://coveralls.io/github/seeren/container?branch=master) [![Packagist](https://img.shields.io/packagist/dt/seeren/container.svg)](https://packagist.org/packages/seeren/container/stats) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/4a0463fb5a084be5bda68e4e36d7c7ac)](https://www.codacy.com/app/seeren/container?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=seeren/container&amp;utm_campaign=Badge_Grade) [![Packagist](https://img.shields.io/packagist/v/seeren/container.svg)](https://packagist.org/packages/seeren/container#) [![Packagist](https://img.shields.io/packagist/l/seeren/log.svg)](LICENSE)

**Resolve and cache dependencies**

> This package contain implementations of the [PSR-11 container interfaces](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-11-container.md)

## Features

* Resolve without configuration.
* Resolve with @param.
* Resolve with providers.

## Installation

Require this package with [composer](https://getcomposer.org/)

```
composer require seeren/container dev-master
```

## Container Usage

#### `Seeren\Container\Container`

A fully qualified class name instance can be resolved and shared.

```php
$foo = $container->get(Foo::class);
```

Resolve return a non shared instance.

```php
$foo = $container->resolve(Foo::class);
```

The container cache manage service persistence, every value type is accepted and closures arent called when service is asked.

```php
$container->set("bar", function ($c) {
    return new Bar($c->get("foo"));
});
$container->set("foo", function ($c) {
    return new Foo;
});
$bar = $container->get("bar");
```

Documentation can be use for that resolved instances can configure params.

```php
class Bar {

	/**
	 * @param Foo $foo
	 */
	public function __construct($foo)
	{
	}

}
```

The container expect a resolver and a cache at construction.

```php
$container = new Container(
    new TypeHintingResolver,
    new CacheContainer
);
```

## Provider Usage

#### `Seeren\Container\Service\ServiceProvider`

Providers are containers configuration setup.

```php
$container->register(new MyProvider);
```

A custom provider have to extends ServiceProvider and add elements to his service attribut.

```php
class MyProvider extends ServiceProvider
{
    public function __construct()
    {
        parent::__construct([
	        "foo" => function ($c) {
	            return new Foo($c->get("bar"));
	        },
	        "bar" => function ($c) {
	            return new Bar;
	        },
        ])
    }
}
```

## Run Unit tests

Run [phpunit](https://phpunit.de/) with [Xdebug](https://xdebug.org/) enabled and [OPcache](http://php.net/manual/fr/book.opcache.php) disabled for coverage.

```
./vendor/bin/phpunit
```

## Run Coverage

Run [coveralls](https://coveralls.io/) for check coverage.

```
./vendor/bin/coveralls -v
```

## License

This project is licensed under the **MIT License** - see the [license](LICENSE) file for details.
