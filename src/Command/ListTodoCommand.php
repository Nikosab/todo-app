<?php

namespace App\Command;

use App\TodoManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListTodoCommand extends Command
{
    protected static $defaultName = 'todo:list';
    private $todoManager;

    public function __construct(TodoManager $todoManager)
    {
        parent::__construct();
        $this->todoManager = $todoManager;
    }

    protected function configure()
    {
        $this->setDescription('List all TODOs');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $todos = $this->todoManager->getTodos();
        $table = new Table($output);
        $table->setHeaders(['Index', 'Description', 'State']);

        foreach ($todos as $index => $todo) {
            $table->addRow([$index, $todo['description'], $todo['state']]);
        }

        $table->render();
        return Command::SUCCESS;
    }
}
