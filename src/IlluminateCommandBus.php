<?php

namespace MinhlhSt\CommandBus;

use Illuminate\Bus\Dispatcher;

class IlluminateCommandBus implements CommandBus
{

    public function __construct(
      protected Dispatcher $dispatcher
    )
    {
    }

    /**
     * @param Command $command
     * @return mixed
     */
    public function dispatch(Command $command): mixed
    {
        return $this->dispatcher->dispatch($command);
    }

    /**
     * @param array<class-string, class-string> $map
     */
    public function register(array $map): void
    {
        $this->dispatcher->map($map);
    }
}
