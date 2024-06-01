<?php

namespace App\Command;

use App\TodoManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteTodoCommand extends Command
{
    protected static $defaultName = 'todo:delete';
    private $todoManager;

    public function __construct(TodoManager $todoManager)
    {
        parent::__construct();
        $this->todoManager = $todoManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Delete a TODO')
            ->addArgument('index', InputArgument::REQUIRED, 'Index of the TODO');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $index = $input->getArgument('index');
        $this->todoManager->deleteTodo($index);
        $output->writeln('TODO deleted');
        return Command::SUCCESS;
    }
}
