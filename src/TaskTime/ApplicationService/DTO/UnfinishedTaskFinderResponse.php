<?php

declare(strict_types=1);

namespace App\TaskTime\ApplicationService\DTO;

use App\Task\Domain\Entity\Task;
use App\TaskTime\Domain\Entity\TaskTime;

readonly class UnfinishedTaskFinderResponse
{
    public function __construct(public Task $task, public ?TaskTime $taskTime)
    {
    }
}
