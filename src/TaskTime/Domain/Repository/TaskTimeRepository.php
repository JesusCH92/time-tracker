<?php

declare(strict_types=1);

namespace App\TaskTime\Domain\Repository;

use App\Task\Domain\Entity\Task;
use App\TaskTime\Domain\Entity\TaskTime;

interface TaskTimeRepository
{
    public function findUnfinishedTask(Task $task): ?TaskTime;

    public function save(TaskTime $taskTime): void;
}
