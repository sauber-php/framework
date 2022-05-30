<a href="https://supportukrainenow.org/"><img src="https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/banner-direct.svg" width="100%"></a>

# Sauber PHP Framework

<!-- BADGES_START -->
![GitHub release (latest by date)](https://img.shields.io/github/v/release/sauber-php/framework)
![Tests](https://github.com/sauber-php/framework/workflows/tests/badge.svg)
![Static Analysis](https://github.com/sauber-php/framework/workflows/static/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/sauber-php/framework.svg?style=flat-square)](https://packagist.org/packages/phpfox/container)
![GitHub](https://img.shields.io/github/license/sauber-php/framework)
<!-- BADGES_END -->

This is the repository for the Sauber PHP Framework.

## Installation

You should not need to install this package, you should use the `sauber-php/sauber` template instead, but if you would
like to manually build your template, please install using composer:

```bash
composer require sauber-php/framework
```

## Usage

To use this package outside of the template, you will need to instantiate it yourself.


### Using the Applications static boot method 

```php
use Sauber\Framework\Application;
use Sauber\Container\Container;

$app = Application::boot(
    container: new Container(),
);

// Register routes here ...

$app->run();
```

### Manually creating the Application

```php
use Sauber\Container\Container;
use Sauber\Framework\Application;
use Sauber\Http\HttpKernel;
use Sauber\Http\Router;

$container = new Container();
$router = new Router(
    container: $container,
);

$app = new Application(
    router: $router,
    kernel: HttpKernel::using(
        router: $router,
    ),
    container: $container,
);

// Register routes here ...

$app->run();
```

### Using the dispatch method

```php
use Sauber\Container\Container;
use Sauber\Framework\Application;
use Sauber\Http\Request;

$app = Application::boot(
    container: new Container(),
);

// Register routes here ...

$app->dispatch(
    request: Request::capture(),
);
```

## Testing

To run the tests:

```bash
./vendor/bin/pest
```

## Static Analysis

To check the static analysis:

```bash
./vendor/bin/phpstan analyse
```

## Changelog

Please see [the Changelog](CHANGELOG.md) for more information on what has changed recently.
