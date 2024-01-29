<?php

declare(strict_types=1);

namespace App\TaskTime\Domain\Repository;

use App\Task\Domain\Entity\Task;
use App\TaskTime\Domain\Entity\TaskTime;
use App\TaskTime\Domain\Entity\TaskTimes;

interface TaskTimeRepository
{
    public function findUnfinishedTask(Task $task): ?TaskTime;

    public function save(TaskTime $taskTime): void;

    public function findAllFinishedTask(Task $task): TaskTimes;
}
