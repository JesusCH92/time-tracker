<?php

namespace App\Tests\TaskTime\TaskTimeInitiator;

use App\Task\Domain\Exception\NotFoundTask;
use App\TaskTime\ApplicationService\DTO\TaskTimeInitiatorRequest;
use App\TaskTime\ApplicationService\TaskTimeInitiator;
use App\TaskTime\Domain\Exception\CantCreateTaskTime;
use App\Tests\TaskTime\DummyTaskRepository;
use App\Tests\TaskTime\DummyTaskTimeRepository;
use App\Tests\TaskTime\StubTaskRepository;
use App\Tests\TaskTime\StubTaskTimeRepository;
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

    /**
     * @test
     * @dataProvider taskTimeInitiatorRequest
     */
    public function throwCantCreateTaskTimeIfExistUnfinishedTask(string $taskName)
    {
        $this->expectException(CantCreateTaskTime::class);

        $service = new TaskTimeInitiator(new DummyTaskRepository(), new StubTaskTimeRepository());

        $service(new TaskTimeInitiatorRequest($taskName));
    }

    /**
     * @test
     * @dataProvider taskTimeInitiatorRequest
     */
    public function shouldCreateTaskTime(string $taskName)
    {
        $spy = new SpyTaskTimeRepository();

        $service = new TaskTimeInitiator(new DummyTaskRepository(), $spy);

        $service(new TaskTimeInitiatorRequest($taskName));

        $this->assertTrue($spy->verify());
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