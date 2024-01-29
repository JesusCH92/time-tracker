<?php

declare(strict_types=1);

namespace App\Task\Infrastructure\Persistence;

use App\Common\Infrastructure\Persistence\DoctrineRepository;
use App\Task\Domain\Entity\Task;
use App\Task\Domain\Entity\Tasks;
use App\Task\Domain\Repository\TaskRepository;

final class DoctrineTaskRepository extends DoctrineRepository implements TaskRepository
{
    public function findById(int $taskId): ?Task
    {
        return $this->repository(Task::class)->findOneBy(['id' => $taskId]);
    }

    public function findAll(string $taskName): Tasks
    {
        $qb = $this
            ->ormQueryBuilder()
            ->select('t')
            ->from(Task::class, 't')
            ->andWhere('t.name LIKE :taskName')
            ->setParameter('taskName', '%' . $taskName . '%');

        $collection = $qb->getQuery()->getResult();

        return new Tasks($collection);
    }

    public function findOneByName(string $name): ?Task
    {
        return $this->repository(Task::class)->findOneBy(['name' => $name]);
    }
}
