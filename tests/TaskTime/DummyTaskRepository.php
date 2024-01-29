<?php

namespace App\Tests\TaskTime;

use App\Task\Domain\Entity\Task;
use App\Task\Domain\Entity\Tasks;
use App\Task\Domain\Repository\TaskRepository;

class DummyTaskRepository implements TaskRepository
{
    public function findById(int $taskId): ?Task
    {
        return new Task('task');
    }

    public function findAll(string $taskName): Tasks
    {
        return new Tasks([]);
    }

    public function findOneByName(string $name): ?Task
    {
        return new Task('name');
    }
}