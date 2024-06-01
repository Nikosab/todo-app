<?php

namespace App\Command;

use App\TodoManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class AddTodoCommand extends Command
{
    protected static $defaultName = 'todo:add';
    private $todoManager;

    public function __construct(TodoManager $todoManager)
    {
        parent::__construct();
        $this->todoManager = $todoManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a new TODO')
            ->addArgument('description', InputArgument::REQUIRED, 'Description of the TODO');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $description = $input->getArgument('description');
        $this->todoManager->addTodo($description);
        $output->writeln('TODO added successfully');
        return Command::SUCCESS;
    }
}