<?php

namespace MinhlhSt\CommandBus;

use Illuminate\Routing\Controller;

class AbsctractController extends Controller
{

    public function __construct(protected CommandBus $commandBus)
    {
    }

    public function dispatch(Command $command): mixed
    {
        return $this->commandBus->dispatch($command);
    }
}
