<?php

declare(strict_types=1);

namespace App\TaskTime\ApplicationService;

use App\Task\Domain\Entity\Task;
use App\Task\Domain\Exception\NotFoundTask;
use App\Task\Domain\Repository\TaskRepository;
use App\TaskTime\ApplicationService\DTO\TaskTimeStoperRequest;
use App\TaskTime\Domain\Entity\TaskTime;
use App\TaskTime\Domain\Exception\NotFoundTaskTime;
use App\TaskTime\Domain\Repository\TaskTimeRepository;

final class TaskTimeStoper
{
    public function __construct(
        private readonly TaskRepository $taskRepository,
        private readonly TaskTimeRepository $repository
    ) {
    }

    public function __invoke(TaskTimeStoperRequest $request): TaskTime
    {
        $task           = $this->findTaskOrFail($request->taskName);
        $unfinishedTask = $this->findUnfinishedTaskOrFail($task);

        $unfinishedTask->finish();

        $this->repository->save($unfinishedTask);

        return $unfinishedTask;
    }

    private function findTaskOrFail(string $taskName): Task
    {
        $task = $this->taskRepository->findOneByName($taskName);

        if (null === $task) {
            throw new NotFoundTask(sprintf('No encontramos la tarea con el nombre <%s>', $taskName));
        }

        return $task;
    }

    private function findUnfinishedTaskOrFail(Task $task): TaskTime
    {
        $unfinishedTask = $this->repository->findUnfinishedTask($task);

        if (null === $unfinishedTask) {
            throw new NotFoundTaskTime('No podemos finalizar una tarea que no ha sido empezada');
        }

        return $unfinishedTask;
    }
}
