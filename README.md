# Seeren\Container

[![Build Status](https://travis-ci.org/seeren/container.svg?branch=master)](https://travis-ci.org/seeren/container) [![Coverage Status](https://coveralls.io/repos/github/seeren/container/badge.svg?branch=master)](https://coveralls.io/github/seeren/container?branch=master) [![Packagist](https://img.shields.io/packagist/dt/seeren/container.svg)](https://packagist.org/packages/seeren/container/stats) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/4a0463fb5a084be5bda68e4e36d7c7ac)](https://www.codacy.com/app/seeren/container?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=seeren/container&amp;utm_campaign=Badge_Grade) [![Packagist](https://img.shields.io/packagist/v/seeren/container.svg)](https://packagist.org/packages/seeren/container#) [![Packagist](https://img.shields.io/packagist/l/seeren/log.svg)](LICENSE)

Autowire and configure dependencies

___

## Installation

Seeren\Container is a [PSR-11 container interfaces](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-11-container.md) implementation

```
composer require seeren/container
```

___

## Seeren\Container\Container

The container create, build, store and share instances

```php
use Seeren\Container\Container;
use Dummy\Foo;

$container = new Container();
$foo = $container->get(Foo::class);
```

### Autowiring

Dependencies are resolved using type declaration

```php
namespace Dummy;

class Foo {
    public function __construct(Bar $bar){}
}

class Bar 
{
    public function __construct(Baz $baz){}
}

class Baz {}
```

### Interfaces

Interfaces are resolved using configuration file by default in `/config/services.json`

```bash
project/
└─ config/
   └─ services.json
```

```php
namespace Dummy;

class Foo {
    public function __construct(BarInterface $bar){}
}
```

```json
{
  "parameters": {},
  "services": {
    "Dummy\\Foo": {
      "Dummy\\Foo\\BarInterface": "Dummy\\Bar"
    }
  }
}
```

### Parameters

Parameters and primitives are resolved using configuration file

```php
namespace Dummy;

class Foo {
    public function __construct(string $bar, string $baz){}
}
```

```json
{
  "parameters": {
    "message": "Hello"
  },
  "services": {
    "Dummy\\Foo": {
      "bar": ":message",
      "baz": "World"
    }
  }
}
```

___

## License

This project is licensed under the MIT License