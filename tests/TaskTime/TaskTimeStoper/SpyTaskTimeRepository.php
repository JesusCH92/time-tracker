<?php

namespace App\Tests\TaskTime\TaskTimeStoper;

use App\Task\Domain\Entity\Task;
use App\TaskTime\Domain\Entity\TaskTime;
use App\TaskTime\Domain\Entity\TaskTimes;
use App\TaskTime\Domain\Repository\TaskTimeRepository;
use App\Tests\Common\Spy;

class SpyTaskTimeRepository extends Spy implements TaskTimeRepository
{
    public function findUnfinishedTask(Task $task): ?TaskTime
    {
        return new TaskTime(new Task('hola'));
    }

    public function save(TaskTime $taskTime): void
    {
        $this->validateWasCalled = true;
    }

    public function findAllFinishedTask(Task $task): TaskTimes
    {
        return new TaskTimes([]);
    }
}