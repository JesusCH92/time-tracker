<?php

declare(strict_types=1);

namespace App\TaskTime\ApplicationService;

use App\Task\Domain\Entity\Task;
use App\Task\Domain\Exception\NotFoundTask;
use App\Task\Domain\Repository\TaskRepository;
use App\TaskTime\ApplicationService\DTO\TaskTimeInitiatorRequest;
use App\TaskTime\Domain\Entity\TaskTime;
use App\TaskTime\Domain\Exception\CantCreateTaskTime;
use App\TaskTime\Domain\Repository\TaskTimeRepository;

final class TaskTimeInitiator
{
    public function __construct(
        private readonly TaskRepository $taskRepository,
        private readonly TaskTimeRepository $repository
    ) {
    }

    public function __invoke(TaskTimeInitiatorRequest $request): TaskTime
    {
        $task = $this->findTaskOrFail($request->taskName);

        $this->failIfUnfinishedTaskExist($task);

        $taskTime = new TaskTime($task);

        $this->repository->save($taskTime);

        return $taskTime;
    }

    private function findTaskOrFail(string $taskName): Task
    {
        $task = $this->taskRepository->findOneByName($taskName);

        if (null === $task) {
            throw new NotFoundTask(sprintf('No encontramos la tarea con el nombre <%s>', $taskName));
        }

        return $task;
    }

    private function failIfUnfinishedTaskExist(Task $task): void
    {
        $unfinishedTaskTime = $this->repository->findUnfinishedTask($task);

        if (null !== $unfinishedTaskTime) {
            throw new CantCreateTaskTime('No se puede inicializar una tarea si aun no se a finalizado la anterior');
        }
    }
}
