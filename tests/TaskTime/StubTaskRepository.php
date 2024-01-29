<?php

namespace App\Tests\TaskTime;

use App\Task\Domain\Entity\Task;
use App\Task\Domain\Entity\Tasks;
use App\Task\Domain\Repository\TaskRepository;

class StubTaskRepository implements TaskRepository
{
    public function findById(int $taskId): ?Task
    {
        return null;
    }

    public function findAll(string $taskName): Tasks
    {
        return new Tasks([]);
    }

    public function findOneByName(string $name): ?Task
    {
        return null;
    }
}