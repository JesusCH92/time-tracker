<?php

declare(strict_types=1);

namespace App\TaskTime\ApplicationService;

use App\Task\Domain\Entity\Task;
use App\Task\Domain\Exception\NotFoundTask;
use App\Task\Domain\Repository\TaskRepository;
use App\TaskTime\ApplicationService\DTO\UnfinishedTaskFinderResponse;
use App\TaskTime\Domain\Entity\TaskTime;
use App\TaskTime\Domain\Repository\TaskTimeRepository;

final class UnfinishedTaskFinder
{
    public function __construct(
        private readonly TaskRepository $taskRepository,
        private readonly TaskTimeRepository $repository
    ) {
    }

    public function __invoke(string $taskName): UnfinishedTaskFinderResponse
    {
        $task = $this->findTaskOrFail($taskName);
        $taskTime = $this->repository->findUnfinishedTask($task);

        return new UnfinishedTaskFinderResponse($task, $taskTime);
    }

    private function findTaskOrFail(string $taskName): Task
    {
        $task = $this->taskRepository->findOneByName($taskName);

        if (null === $task) {
            throw new NotFoundTask(sprintf('No encontramos la tarea con el identificador <%s>', $taskId));
        }

        return $task;
    }
}
