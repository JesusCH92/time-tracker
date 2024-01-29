<?php

declare(strict_types=1);

namespace App\TaskTime\Infrastructure\Command;

use App\TaskTime\ApplicationService\DTO\TaskTimeInitiatorRequest;
use App\TaskTime\ApplicationService\TaskTimeInitiator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app.task_time_init',
    description: 'Inicio de la tarea',
)]
class TaskTimeInitiatorCommand extends Command
{
    public function __construct(private readonly TaskTimeInitiator $taskTimeInitiator)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addOption('task_name', null, InputOption::VALUE_REQUIRED, 'Nombre de la tarea.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $taskName = $input->getOption('task_name');

        try {
            ($this->taskTimeInitiator)(new TaskTimeInitiatorRequest($taskName));
        } catch (\Exception $e) {
            $io->error($e->getMessage());

            return Command::FAILURE;
        }

        $io->success('Se inicio la tarea.');

        return Command::SUCCESS;

    }
}