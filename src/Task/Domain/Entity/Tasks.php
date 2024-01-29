<?php

declare(strict_types=1);

namespace App\Task\Domain\Entity;

use App\Common\Domain\Collection;

final class Tasks extends Collection
{
    protected function type(): string
    {
        return Task::class;
    }

    public function mappingDropdown(): array
    {
        return array_map(fn(Task $task) => ['id' => $task->id(), 'text' => $task->name()], $this->items());
    }
}
