<?php

declare(strict_types=1);

namespace Sauber\Framework\Contracts;

use League\Route\Route;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
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
     * @param mixed $handler
     * @return Route
     */
    public function get(string $path, mixed $handler): Route;

    /**
     * @param string $path
     * @param mixed $handler
     * @return Route
     */
    public function post(string $path, mixed $handler): Route;

    /**
     * @param string $path
     * @param mixed $handler
     * @return Route
     */
    public function put(string $path, mixed $handler): Route;

    /**
     * @param string $path
     * @param mixed $handler
     * @return Route
     */
    public function patch(string $path, mixed $handler): Route;

    /**
     * @param string $path
     * @param mixed $handler
     * @return Route
     */
    public function delete(string $path, mixed $handler): Route;

    /**
     * @param string $path
     * @param mixed $handler
     * @return Route
     */
    public function head(string $path, mixed $handler): Route;

    /**
     * @param string $path
     * @param mixed $handler
     * @return Route
     */
    public function options(string $path, mixed $handler): Route;

    /**
     * @param string $method
     * @param string $path
     * @param mixed $handler
     * @return Route
     */
    public function match(string $method, string $path, mixed $handler): Route;

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
