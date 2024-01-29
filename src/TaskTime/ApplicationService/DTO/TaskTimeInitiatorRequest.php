<?php

declare(strict_types=1);

namespace App\TaskTime\ApplicationService\DTO;

readonly class TaskTimeInitiatorRequest
{
    public function __construct(public string $taskName)
    {
    }
}
