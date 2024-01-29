<?php

declare(strict_types=1);

namespace App\Task\Domain\Repository;

use App\Task\Domain\Entity\Task;

interface TaskRepository
{
    public function findById(int $taskId): ?Task;
}
