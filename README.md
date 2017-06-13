# container
 [![Build Status](https://travis-ci.org/seeren/container.svg?branch=master)](https://travis-ci.org/seeren/container) [![Coverage Status](https://coveralls.io/repos/github/seeren/container/badge.svg?branch=master)](https://coveralls.io/github/seeren/container?branch=master) [![Packagist](https://img.shields.io/packagist/dt/seeren/container.svg)](https://packagist.org/packages/seeren/container/stats) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/4a0463fb5a084be5bda68e4e36d7c7ac)](https://www.codacy.com/app/seeren/container?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=seeren/container&amp;utm_campaign=Badge_Grade) [![Packagist](https://img.shields.io/packagist/v/seeren/container.svg)](https://packagist.org/packages/seeren/container#) [![Packagist](https://img.shields.io/packagist/l/seeren/log.svg)](LICENSE)

**Resolve and cache dependencies**

## Features
* Resolve without configuration
* Resolve with @param
* Resolve with providers

## Installation
Require this package with [composer](https://getcomposer.org/)
```
composer require seeren/container dev-master
```

## Container Usage

#### `Seeren\Container\Container`
Container need a resolver and a cache at construction, the resolver is a factory like whereas the cache manage persistence
```php
$container = new Container(
    new TypeHintingResolver(),
    new CacheContainer());
```
A fully qualified class name can be resolved without configuration
```php
$foo = $container->get(Foo::class);
```
The cache manage service persistence and can be used as configuration
```php
$container->set("foo", function ($c) {
    return new Foo($c->get("bar"));
});
$container->set("bar", function ($c) {
    return new Bar;
});
$foo = $container->get("foo");
```

## Provider Usage
#### `Seeren\Container\Service\ServiceProvider`
Providers are configuration setup, container can register them
```php
$container->register(new MyProvider);
$foo = $container->get("foo");
```
A custom provider have to extends ServiceProvider and add element to his service attribut
```php
class MyProvider extends ServiceProvider
{
    public function __construct()
    {
        parent::__construct();
        $this->service["foo"] = function ($c) {
            return new Foo($c->get("bar"));
        }
        $this->service["bar"] = function ($c) {
            return new Bar;
        }
    }
}
```

## Run Unit tests
Install dependencies
```
composer update
```
Run [phpunit](https://phpunit.de/) with [Xdebug](https://xdebug.org/) enabled and [OPcache](http://php.net/manual/fr/book.opcache.php) disabled for coverage
```
./vendor/bin/phpunit
```
## Run Coverage
Install dependencies
```
composer update
```
Run [coveralls](https://coveralls.io/) for check coverage
```
./vendor/bin/coveralls -v
```

##  Contributors
* **Cyril Ichti** - *Initial work* - [seeren](https://github.com/seeren)

## License
This project is licensed under the **MIT License** - see the [license](LICENSE) file for details.