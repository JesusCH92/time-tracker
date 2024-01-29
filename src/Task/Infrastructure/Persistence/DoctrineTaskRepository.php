<?php

declare(strict_types=1);

namespace App\Task\Infrastructure\Persistence;

use App\Common\Infrastructure\Persistence\DoctrineRepository;
use App\Task\Domain\Entity\Task;
use App\Task\Domain\Repository\TaskRepository;

final class DoctrineTaskRepository extends DoctrineRepository implements TaskRepository
{
    public function findById(int $taskId): ?Task
    {
        return $this->repository(Task::class)->findOneBy(['id' => $taskId]);
    }
}
