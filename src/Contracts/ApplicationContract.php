<?php

declare(strict_types=1);

namespace Sauber\Framework\Contracts;

use Closure;
use League\Route\Route;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sauber\Http\HttpKernel;
use Sauber\Http\Router;

interface ApplicationContract
{
    /**
     * @param ContainerInterface $container
     * @return ApplicationContract
     */
    public static function boot(ContainerInterface $container): ApplicationContract;

    /**
     * @return Router
     */
    public function router(): Router;

    /**
     * @return HttpKernel
     */
    public function kernel(): HttpKernel;

    /**
     * @return ContainerInterface
     */
    public function container(): ContainerInterface;

    /**
     * @param string $path
     * @param class-string<RequestHandlerInterface>|Closure $handler
     * @return Route
     */
    public function get(string $path, string|Closure $handler): Route;

    /**
     * @param string $path
     * @param class-string<RequestHandlerInterface>|Closure $handler
     * @return Route
     */
    public function post(string $path, string|Closure $handler): Route;

    /**
     * @param string $path
     * @param class-string<RequestHandlerInterface>|Closure $handler
     * @return Route
     */
    public function put(string $path, string|Closure $handler): Route;

    /**
     * @param string $path
     * @param class-string<RequestHandlerInterface>|Closure $handler
     * @return Route
     */
    public function patch(string $path, string|Closure $handler): Route;

    /**
     * @param string $path
     * @param class-string<RequestHandlerInterface>|Closure $handler
     * @return Route
     */
    public function delete(string $path, string|Closure $handler): Route;

    /**
     * @param string $path
     * @param class-string<RequestHandlerInterface>|Closure $handler
     * @return Route
     */
    public function head(string $path, string|Closure $handler): Route;

    /**
     * @param string $path
     * @param class-string<RequestHandlerInterface>|Closure $handler
     * @return Route
     */
    public function options(string $path, string|Closure $handler): Route;

    /**
     * @param string $method
     * @param string $path
     * @param class-string<RequestHandlerInterface>|Closure $handler
     * @return Route
     */
    public function match(string $method, string $path, string|Closure $handler): Route;

    /**
     * @param ServerRequestInterface $request
     * @return void
     */
    public function dispatch(ServerRequestInterface $request): void;

    /**
     * @return void
     */
    public function run(): void;
}
