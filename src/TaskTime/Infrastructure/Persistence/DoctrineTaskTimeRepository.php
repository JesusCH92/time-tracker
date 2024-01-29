<?php

declare(strict_types=1);

namespace App\TaskTime\Infrastructure\Persistence;

use App\Common\Infrastructure\Persistence\DoctrineRepository;
use App\Task\Domain\Entity\Task;
use App\TaskTime\Domain\Entity\TaskTime;
use App\TaskTime\Domain\Entity\TaskTimes;
use App\TaskTime\Domain\Repository\TaskTimeRepository;

final class DoctrineTaskTimeRepository extends DoctrineRepository implements TaskTimeRepository
{
    public function findUnfinishedTask(Task $task): ?TaskTime
    {
        $qb = $this
            ->ormQueryBuilder()
            ->select('tt')
            ->from(TaskTime::class, 'tt')
            ->join('tt.task', 't')
            ->andWhere('tt.endDate IS NULL')
            ->andWhere('t.id = :taskId')
            ->setParameter('taskId', $task->id());

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function save(TaskTime $taskTime): void
    {
        $this->entityManager()->persist($taskTime);
        $this->entityManager()->flush();
    }

    public function findAllFinishedTask(Task $task): TaskTimes
    {
        $qb = $this
            ->ormQueryBuilder()
            ->select('tt')
            ->from(TaskTime::class, 'tt')
            ->join('tt.task', 't')
            ->andWhere('tt.endDate IS NOT NULL')
            ->andWhere('t.id = :taskId')
            ->setParameter('taskId', $task->id())
            ->orderBy('tt.id', 'DESC');

        $collection = $qb->getQuery()->getResult();

        return new TaskTimes($collection);
    }
}
