<?php

declare(strict_types=1);

use League\Route\Route;
use Psr\Container\ContainerInterface;
use Sauber\Container\Container;
use Sauber\Framework\Application;
use Sauber\Framework\Contracts\ApplicationContract;
use Sauber\Framework\Tests\Fixtures\DummyRequestHandler;
use Sauber\Http\HttpKernel;
use Sauber\Http\Router;

it('can boot with a container', function () {
    expect(
        Application::boot(
            container: new Container(),
        )
    )->toBeInstanceOf(ApplicationContract::class);
});

it('can be built manually', function () {
    $container = new Container();
    $router = new Router(
        container: $container,
    );

    expect(
        new Application(
            router: new Router(
                container: $container,
            ),
            kernel: new HttpKernel(
                requestHandler: $router,
            ),
            container: $container,
        ),
    )->toBeInstanceOf(ApplicationContract::class);
});

it('can access the router', function () {
    $app = Application::boot(
        container: new Container(),
    );

    expect(
        $app->router(),
    )->toBeInstanceOf(Router::class);
});

it('can access the kernel', function () {
    $app = Application::boot(
        container: new Container(),
    );

    expect(
        $app->kernel(),
    )->toBeInstanceOf(HttpKernel::class);
});

it('can access the container', function () {
    $app = Application::boot(
        container: new Container(),
    );

    expect(
        $app->container(),
    )->toBeInstanceOf(ContainerInterface::class);
});

it('can register a get request', function () {
    $app = Application::boot(
        container: new Container(),
    );

    expect(
        $app->get('/', DummyRequestHandler::class),
    )->toBeInstanceOf(Route::class)->getMethod()->toEqual('GET');
});

it('can register a post request', function () {
    $app = Application::boot(
        container: new Container(),
    );

    expect(
        $app->post('/', DummyRequestHandler::class),
    )->toBeInstanceOf(Route::class)->getMethod()->toEqual('POST');
});

it('can register a put request', function () {
    $app = Application::boot(
        container: new Container(),
    );

    expect(
        $app->put('/', DummyRequestHandler::class),
    )->toBeInstanceOf(Route::class)->getMethod()->toEqual('PUT');
});

it('can register a patch request', function () {
    $app = Application::boot(
        container: new Container(),
    );

    expect(
        $app->patch('/', DummyRequestHandler::class),
    )->toBeInstanceOf(Route::class)->getMethod()->toEqual('PATCH');
});

it('can register a delete request', function () {
    $app = Application::boot(
        container: new Container(),
    );

    expect(
        $app->delete('/', DummyRequestHandler::class),
    )->toBeInstanceOf(Route::class)->getMethod()->toEqual('DELETE');
});

it('can register a head request', function () {
    $app = Application::boot(
        container: new Container(),
    );

    expect(
        $app->head('/', DummyRequestHandler::class),
    )->toBeInstanceOf(Route::class)->getMethod()->toEqual('HEAD');
});

it('can register an options request', function () {
    $app = Application::boot(
        container: new Container(),
    );

    expect(
        $app->options('/', DummyRequestHandler::class),
    )->toBeInstanceOf(Route::class)->getMethod()->toEqual('OPTIONS');
});

it('can map a new route', function (string $verb) {
    $app = Application::boot(
        container: new Container(),
    );

    expect(
        $app->match($verb, '/', DummyRequestHandler::class),
    )->toBeInstanceOf(Route::class)->getMethod()->toEqual($verb);
})->with('verbs');
