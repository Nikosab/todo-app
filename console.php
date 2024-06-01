<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\TodoManager;
use App\Command\AddTodoCommand;
use App\Command\ListTodoCommand;
use App\Command\CompleteTodoCommand;
use App\Command\DeleteTodoCommand;

$application = new Application();

$todoManager = new TodoManager();
$application->add(new AddTodoCommand($todoManager));
$application->add(new ListTodoCommand($todoManager));
$application->add(new CompleteTodoCommand($todoManager));
$application->add(new DeleteTodoCommand($todoManager));

$application->run();
