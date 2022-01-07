# Seeren\\Container

[![Build](https://app.travis-ci.com/seeren/http.svg?branch=master)](https://app.travis-ci.com/seeren/container)
[![Require](https://poser.pugx.org/seeren/container/require/php)](https://packagist.org/packages/seeren/container)
[![Coverage](https://coveralls.io/repos/github/seeren/error/badge.svg?branch=master)](https://coveralls.io/github/seeren/container?branch=master)
[![Download](https://img.shields.io/packagist/dt/seeren/container.svg)](https://packagist.org/packages/seeren/container/stats)
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/c8dba7431c6e4bebbb956387fc827b0d)](https://www.codacy.com/gh/seeren/container/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=seeren/container&amp;utm_campaign=Badge_Grade)
[![Version](https://img.shields.io/packagist/v/seeren/container.svg)](https://packagist.org/packages/seeren/container)

Autowire and configure dependencies

* * *

## Installation

Seeren\\Container is a [PSR-11 container interfaces](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-11-container.md) implementation

```bash
composer require seeren/container
```
* * *

## Seeren\\Container\\Container

The container create, build, store and share instances

```php
use Seeren\Container\Container;

$container = new Container();

$foo = $container->get('Dummy\Foo');
```

### Autowiring

Dependencies are resolved using type declaration

```php
namespace Dummy;

class Foo
{
    public function __construct(Bar $bar){}
}

class Bar 
{
    public function __construct(Baz $baz){}
}

class Baz {}
```

### Interfaces

```php
namespace Dummy;

class Foo {
    public function __construct(BarInterface $bar){}
}
```

Interfaces are resolved using configuration file by default in `/config/services.json`


```json
{
  "parameters": {},
  "services": {
    "Dummy\\Foo": {
      "Dummy\\BarInterface": "Dummy\\Bar"
    }
  }
}
```

Include path can be specified at construction

```bash
project/
└─ config/
   └─ services.json
```


### Parameters

Parameters and primitives are resolved using configuration file

```php
namespace Dummy;

class Foo
{
    public function __construct(string $bar){}
}
```

```json
{
  "parameters": {
    "message": "Hello"
  },
  "services": {
    "Dummy\\Foo": {
      "bar": ":message"
    }
  }
}
```

### Methods

Methods can use autowiring

```php
namespace Dummy;

class Foo
{

    public function __construct(BarInterface $bar){}

    public function action(int $id, Baz $baz)
    {
        return 'Hello';
    }

}
```

```php
use Seeren\Container\Container;

$container = new Container();

$message = $container->call('Dummy\Foo', 'action', [7]);

echo $message; // Hello
```

* * *

## License

This project is licensed under the [MIT](./LICENSE) License
