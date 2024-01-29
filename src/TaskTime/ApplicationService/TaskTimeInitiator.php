<?php

declare(strict_types=1);

namespace App\TaskTime\ApplicationService;

use App\Task\Domain\Entity\Task;
use App\Task\Domain\Exception\NotFoundTask;
use App\Task\Domain\Repository\TaskRepository;
use App\TaskTime\ApplicationService\DTO\TaskTimeInitiatorRequest;
use App\TaskTime\Domain\Entity\TaskTime;
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
        $task                    = $this->findTaskOrFail($request->taskId);
        $unfinishedTaskTimeExist = $this->repository->findUnfinishedTask($task);

        $taskTime = $unfinishedTaskTimeExist ?? new TaskTime($task);

        if (null === $unfinishedTaskTimeExist) {
            $this->repository->save($taskTime);
        }

        return $taskTime;
    }

    private function findTaskOrFail(int $taskId): Task
    {
        $task = $this->taskRepository->findById($taskId);

        if (null === $task) {
            throw new NotFoundTask(sprintf('No encontramos la tarea con el identificador <%s>', $taskId));
        }

        return $task;
    }
}
