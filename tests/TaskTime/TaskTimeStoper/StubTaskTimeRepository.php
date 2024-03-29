<?php

namespace App\Tests\TaskTime\TaskTimeStoper;

use App\Task\Domain\Entity\Task;
use App\TaskTime\Domain\Entity\TaskTime;
use App\TaskTime\Domain\Entity\TaskTimes;
use App\TaskTime\Domain\Repository\TaskTimeRepository;

class StubTaskTimeRepository implements TaskTimeRepository
{
    public function findUnfinishedTask(Task $task): ?TaskTime
    {
        return null;
    }

    public function save(TaskTime $taskTime): void
    {
    }

    public function findAllFinishedTask(Task $task): TaskTimes
    {
        return new TaskTimes([]);
    }
}