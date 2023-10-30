# Command Bus

>ST team Simple Command Bus for Laravel framework

## Installation
    composer require minhlhst/command-bus

If your Laravel version is less than 5.5, add the following line to the providers array in `config / app.php`:
```php
MinhlhSt\CommandBus\CommandBusServiceProvider::class,
```

## Example

```php
class UserController extends Controller
{
    public function store(Request $request)
    {
        $user = $this->dispatch(new RegisterUserCommand(
            $request->input('email'),
            $request->input('password')
        ));
    
        return $user;
    }
}
```

## Usage

#### Command

```php
use MinhlhSt\CommandBus\Command;

class RegisterUserCommand implements Command
{
     public function __construct(
        private string $name,
        private string $password
    )
    {
    }
    
    public function email(): string
    {
        return $this->email;
    }
    
    public function password(): string
    {
        return $this->password;
    }
    
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
```

#### Handler

```php

use MinhlhSt\CommandBus\Handler;
use MinhlhSt\CommandBus\Command;

class RegisterUserHandler implements Handler
{
    private $userRepository;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function handle(Command $command): User
    {
        $user = new User(
            $command->email(),
            $command->password()
        );
        
        $this->userRepository->store($user);
        
        return $user;
    }
}
```

#### Controllers

```php
use MinhlhSt\CommandBus\AbsctractController;
use MinhlhSt\CommandBus\CommandBus;
use MinhlhSt\CommandBus\Command;

class Controller extends AbsctractController
{
    private $dispatcher;
    
    public function __construct(CommandBus $dispatcher) 
    {
        $this->dispatcher = $dispatcher;
    }
    
    public function dispatch(Command $command)
    {
        return $this->dispatcher->execute($command);
    }
}
```

```php
class UserController extends Controller
{
    public function store(Request $request)
    {
        $user = $this->dispatch(new RegisterUserCommand(
            $request->input('email'),
            $request->input('password')
        ));
    
        return $user;
    }
}
```
