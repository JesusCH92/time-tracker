<?php

namespace App\TaskTime\Infrastructure\Command;

use App\TaskTime\ApplicationService\FinishedTaskFinder;
use App\TaskTime\Domain\Entity\TaskTime;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app.finished_task_times',
    description: 'Inicio de la tarea',
)]
class FinishedTaskFinderCommand extends Command
{
    public function __construct(private readonly FinishedTaskFinder $finishedTaskFinder)
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
            $taskTimes = ($this->finishedTaskFinder)($taskName);
        } catch (\Exception $e) {
            $io->error($e->getMessage());

            return Command::FAILURE;
        }

        $io->success('Listado de inputacion de la tarea.');

        $collection = array_map(
            fn(TaskTime $taskTime) => [
                'start' => $taskTime->startDate()->format('Y-m-d H:i:s'),
                'end' => $taskTime->endDate()->format('Y-m-d H:i:s'),
                'interval' => $taskTime->intervalTaskTime()
            ],
            $taskTimes->items()
        );

        $io->table(['start date', 'end date', 'interval in hours'], $collection);

        return Command::SUCCESS;
    }
}