## Seeren\Container\

Psr 11 implementation, resolve and cache dependencies.

#### Code Example

Can be used for resolve whole app, manage persistence or register providers.

### Seeren\Container\Container

Container need resolver and cache at construction then provide get and has methods. Resolver is a factory like using reflection whereas Cache manage persistence of services.

```php
$container = new Container(
    new TypeHintingResolver(),
    new CacheContainer());

$controller = $container->get(MyController::class);
```

### Seeren\Container\Resolver\ResolverContainer

Differents resolvers can try to return new service.

```php
$controller = (new TypeHintingResolver)->resolve(MyController::class);
```

### Seeren\Container\Cache\CacheContainer

Cache manage service persistence for a container.

```php
$cache = new CacheContainer;
$cache->set("foo", function ($c) { return $c->get("bar"); });
$cache->set("bar", function ($c) { return "bar"; });
$bar = $cache->get("foo");
```

### Seeren\Container\Service\ServiceProvider

Cache container can register providers.

```php
$cache = new CacheContainer;
$cache->register($myServiceProvider);
```

#### Running the tests

Running tests with phpunit in the test folder.

```
$ phpunit test/ContainerTest.php
$ phpunit test/ResolverContainerTest.php
$ phpunit test/CacheContainerTest.php
```