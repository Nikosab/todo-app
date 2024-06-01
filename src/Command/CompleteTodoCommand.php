<?php

namespace App\Command;

use App\TodoManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class CompleteTodoCommand extends Command
{
    protected static $defaultName = 'todo:complete';
    private $todoManager;

    public function __construct(TodoManager $todoManager)
    {
        parent::__construct();
        $this->todoManager = $todoManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Mark a TODO as completed')
            ->addArgument('index', InputArgument::REQUIRED, 'Index of the TODO');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $index = $input->getArgument('index');
        $this->todoManager->completeTodo($index);
        $output->writeln('TODO marked as completed');
        return Command::SUCCESS;
    }
}
