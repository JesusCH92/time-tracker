<?php

declare(strict_types=1);

namespace App\Task\ApplicationService;

use App\Task\Domain\Entity\Tasks;
use App\Task\Domain\Repository\TaskRepository;

final class AllTaskGetter
{
    public function __construct(private readonly TaskRepository $repository)
    {
    }

    public function __invoke(string $taskName): Tasks
    {
        return $this->repository->findAll($taskName);
    }
}
