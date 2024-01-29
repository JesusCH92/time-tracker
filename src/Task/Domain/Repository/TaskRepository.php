<?php

declare(strict_types=1);

namespace App\Task\Domain\Repository;

use App\Task\Domain\Entity\Task;
use App\Task\Domain\Entity\Tasks;

interface TaskRepository
{
    public function findById(int $taskId): ?Task;

    public function findAll(string $taskName): Tasks;
}
