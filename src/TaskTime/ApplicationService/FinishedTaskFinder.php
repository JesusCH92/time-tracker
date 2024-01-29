<?php

declare(strict_types=1);

namespace App\TaskTime\ApplicationService;

use App\Task\Domain\Entity\Task;
use App\Task\Domain\Exception\NotFoundTask;
use App\Task\Domain\Repository\TaskRepository;
use App\TaskTime\Domain\Entity\TaskTimes;
use App\TaskTime\Domain\Repository\TaskTimeRepository;

final class FinishedTaskFinder
{
    public function __construct(
        private readonly TaskRepository $taskRepository,
        private readonly TaskTimeRepository $repository
    ) {
    }

    public function __invoke(string $taskName): TaskTimes
    {
        $task = $this->findTaskOrFail($taskName);

        return $this->repository->findAllFinishedTask($task);
    }

    private function findTaskOrFail(string $taskName): Task
    {
        $task = $this->taskRepository->findOneByName($taskName);

        if (null === $task) {
            throw new NotFoundTask(sprintf('No encontramos la tarea con el nombre <%s>', $taskName));
        }

        return $task;
    }
}
