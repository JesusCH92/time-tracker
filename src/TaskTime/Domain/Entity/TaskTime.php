<?php

declare(strict_types=1);

namespace App\TaskTime\Domain\Entity;

use App\Task\Domain\Entity\Task;
use DateInterval;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class TaskTime
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'task_id', nullable: false)]
    private Task $task;
    #[ORM\Column(name: 'start_date', type: Types::DATETIME_IMMUTABLE, nullable: false)]
    private DateTimeImmutable $startDate;
    #[ORM\Column(name: 'end_date', type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?DateTimeImmutable $endDate = null;

    public function __construct(Task $task)
    {
        $this->task = $task;
        $this->startDate = new DateTimeImmutable();
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function task(): Task
    {
        return $this->task;
    }

    public function startDate(): DateTimeImmutable
    {
        return $this->startDate;
    }

    public function endDate(): ?DateTimeImmutable
    {
        return $this->endDate;
    }

    public function isUnfinished(): bool
    {
        return $this->endDate() === null;
    }

    public function finish(): void
    {
        $this->endDate = new DateTimeImmutable();
    }

    public function intervalTaskTime(): int|float
    {
        $intervalo = $this->startDate()->diff($this->endDate());
        return $this->intervalHoursInDecimals($intervalo);
    }

    private function intervalHoursInDecimals(DateInterval $intervalo): int|float
    {
        $minutosTotales = $intervalo->days * 24 * 60;
        $minutosTotales += $intervalo->h * 60;
        $minutosTotales += $intervalo->i;

        $horasDecimales = $minutosTotales / 60;

        return $horasDecimales;
    }
}
