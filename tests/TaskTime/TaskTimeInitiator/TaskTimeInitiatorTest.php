<?php

namespace App\Tests\TaskTime\TaskTimeInitiator;

use App\Task\Domain\Exception\NotFoundTask;
use App\TaskTime\ApplicationService\DTO\TaskTimeInitiatorRequest;
use App\TaskTime\ApplicationService\TaskTimeInitiator;
use App\Tests\TaskTime\DummyTaskTimeRepository;
use App\Tests\TaskTime\StubTaskRepository;
use PHPUnit\Framework\TestCase;

class TaskTimeInitiatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider taskTimeInitiatorRequest
     */
    public function throwNotFoundTaskIfTaskNameNotExist(string $taskName)
    {
        $this->expectException(NotFoundTask::class);

        $service = new TaskTimeInitiator(new StubTaskRepository(), new DummyTaskTimeRepository());

        $service(new TaskTimeInitiatorRequest($taskName));
    }

    public function taskTimeInitiatorRequest(): array
    {
        return [
            ['task 1'],
            ['task 2'],
            ['task 3'],
            ['task 4'],
            ['task 5'],
            ['task 6'],
            ['task 7'],
            ['task 8'],
            ['task 9'],
            ['task 10'],
            ['task 11'],
            ['task 12'],
            ['task 13'],
            ['task 14'],
            ['task 15'],
            ['task 16'],
            ['task 17'],
            ['task 18'],
            ['task 19'],
            ['task 20'],
            ['task 21'],
        ];
    }
}