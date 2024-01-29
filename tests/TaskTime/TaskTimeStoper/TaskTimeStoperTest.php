<?php

namespace App\Tests\TaskTime\TaskTimeStoper;

use App\Task\Domain\Exception\NotFoundTask;
use App\TaskTime\ApplicationService\DTO\TaskTimeStoperRequest;
use App\TaskTime\ApplicationService\TaskTimeStoper;
use App\TaskTime\Domain\Exception\NotFoundTaskTime;
use App\Tests\TaskTime\DummyTaskRepository;
use App\Tests\TaskTime\DummyTaskTimeRepository;
use App\Tests\TaskTime\StubTaskRepository;
use PHPUnit\Framework\TestCase;

class TaskTimeStoperTest extends TestCase
{
    /**
     * @test
     * @dataProvider taskTimeStoperRequest
     */
    public function throwNotFoundTaskIfTaskNameNotExist(string $taskName)
    {
        $this->expectException(NotFoundTask::class);

        $service = new TaskTimeStoper(new StubTaskRepository(), new DummyTaskTimeRepository());

        $service(new TaskTimeStoperRequest($taskName));
    }

    /**
     * @test
     * @dataProvider taskTimeStoperRequest
     */
    public function throwNotFoundTaskTimeIfTaskTimeIsNotStarted(string $taskName)
    {
        $this->expectException(NotFoundTaskTime::class);

        $service = new TaskTimeStoper(new DummyTaskRepository(), new StubTaskTimeRepository());

        $service(new TaskTimeStoperRequest($taskName));
    }

    /**
     * @test
     * @dataProvider taskTimeStoperRequest
     */
    public function shouldFinishedTaskTime(string $taskName)
    {
        $spy = new SpyTaskTimeRepository();
        $service = new TaskTimeStoper(new DummyTaskRepository(), $spy);

        $service(new TaskTimeStoperRequest($taskName));

        $this->assertTrue($spy->verify());
    }

    public function taskTimeStoperRequest(): array
    {
        return [
            ['task 10'],
            ['task 20'],
            ['task 30'],
            ['task 40'],
            ['task 50'],
            ['task 60'],
            ['task 70'],
            ['task 80'],
            ['task 90'],
            ['task 100'],
            ['task 110'],
            ['task 120'],
            ['task 130'],
            ['task 140'],
            ['task 150'],
            ['task 160'],
            ['task 170'],
            ['task 180'],
            ['task 190'],
            ['task 200'],
            ['task 210'],
        ];
    }
}