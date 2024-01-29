<?php

declare(strict_types=1);

namespace App\TaskTime\ApplicationService\DTO;

readonly class TaskTimeStoperRequest
{
    public function __construct(public string $taskName)
    {
    }
}
