<?php

declare(strict_types=1);

namespace Sauber\Framework;

use League\Route\Route;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Sauber\Framework\Contracts\ApplicationContract;
use Sauber\Http\HttpKernel;
use Sauber\Http\Request;
use Sauber\Http\Router;

final class Application implements ApplicationContract
{
    /**
     * @param Router $router
     * @param HttpKernel $kernel
     * @param ContainerInterface $container
     */
    public function __construct(
        private readonly Router $router,
        private readonly HttpKernel $kernel,
        private readonly ContainerInterface $container,
    ) {}

    /**
     * @param ContainerInterface $container
     * @return ApplicationContract
     */
    public static function boot(ContainerInterface $container): ApplicationContract
    {
        $router = new Router(
            container: $container,
        );

        return new Application(
            router: $router,
            kernel: HttpKernel::using(
                requestHandler: $router,
            ),
            container: $container,
        );
    }

    /**
     * @return Router
     */
    public function router(): Router
    {
        return $this->router;
    }

    /**
     * @return HttpKernel
     */
    public function kernel(): HttpKernel
    {
        return $this->kernel;
    }

    /**
     * @return ContainerInterface
     */
    public function container(): ContainerInterface
    {
        return $this->container;
    }

    /**
     * @param string $path
     * @param mixed $handler
     * @return Route
     */
    public function get(string $path, mixed $handler): Route
    {
        return $this->match(
            method: 'GET',
            path: $path,
            handler: $handler,
        );
    }

    /**
     * @param string $path
     * @param mixed $handler
     * @return Route
     */
    public function post(string $path, mixed $handler): Route
    {
        return $this->match(
            method: 'POST',
            path: $path,
            handler: $handler,
        );
    }

    /**
     * @param string $path
     * @param mixed $handler
     * @return Route
     */
    public function put(string $path, mixed $handler): Route
    {
        return $this->match(
            method: 'PUT',
            path: $path,
            handler: $handler,
        );
    }

    /**
     * @param string $path
     * @param mixed $handler
     * @return Route
     */
    public function patch(string $path, mixed $handler): Route
    {
        return $this->match(
            method: 'PATCH',
            path: $path,
            handler: $handler,
        );
    }

    /**
     * @param string $path
     * @param mixed $handler
     * @return Route
     */
    public function delete(string $path, mixed $handler): Route
    {
        return $this->match(
            method: 'DELETE',
            path: $path,
            handler: $handler,
        );
    }

    /**
     * @param string $path
     * @param mixed $handler
     * @return Route
     */
    public function head(string $path, mixed $handler): Route
    {
        return $this->match(
            method: 'HEAD',
            path: $path,
            handler: $handler,
        );
    }

    /**
     * @param string $path
     * @param mixed $handler
     * @return Route
     */
    public function options(string $path, mixed $handler): Route
    {
        return $this->match(
            method: 'OPTIONS',
            path: $path,
            handler: $handler,
        );
    }

    /**
     * @param string $method
     * @param string $path
     * @param mixed $handler
     * @return Route
     */
    public function match(string $method, string $path, mixed $handler): Route
    {
        return $this->router()->map(
            method: $method,
            path: $path,
            handler: $handler,
        );
    }

    /**
     * @param ServerRequestInterface $request
     * @return void
     */
    public function dispatch(ServerRequestInterface $request): void
    {
        $this->kernel()->dispatch(
            request: $request,
        );
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $this->kernel()->dispatch(
            request: Request::capture(),
        );
    }
}
