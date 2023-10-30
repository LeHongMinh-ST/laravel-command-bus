<?php

namespace MinhlhSt\CommandBus;

use Illuminate\Routing\Controller;

class AbsctractController extends Controller
{

    public function __construct(protected readonly CommandBus $dispatcher)
    {
    }

    public function dispatch(Command $command)
    {
        return $this->dispatcher->execute($command);
    }
}
