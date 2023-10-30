<?php
declare(strict_types=1);

namespace MinhlhSt\CommandBus;

use Illuminate\Container\Container as IoC;
use Illuminate\Contracts\Container\BindingResolutionException;

class LaravelContainer implements Container
{
    /**
     * @var Container|IoC
     */
    private Container|IoC $container;

    /**
     * Create a new LaravelContainer
     *
     * @param IoC $container
     */
    public function __construct(IoC $container)
    {
        $this->container = $container;
    }

    /**
     * Resolve the class out of the Container
     *
     * @param string $class
     *
     * @return mixed
     * @throws BindingResolutionException
     */
    public function make(string $class): mixed
    {
        return $this->container->make($class);
    }
}
