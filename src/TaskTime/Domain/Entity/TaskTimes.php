<?php

declare(strict_types=1);

namespace App\TaskTime\Domain\Entity;

use App\Common\Domain\Collection;

final class TaskTimes extends Collection
{
    protected function type(): string
    {
        return TaskTime::class;
    }
}
