<?php

declare(strict_types=1);

namespace App\TaskTime\Infrastructure\Controller;

use App\Common\Domain\Constant\SessionVariable;
use App\Common\Infrastructure\Framework\SymfonyWebController;
use App\Task\Infrastructure\Framework\Form\Model\TaskFormModel;
use App\Task\Infrastructure\Framework\Form\TaskFormType;
use App\TaskTime\ApplicationService\DTO\TaskTimeInitiatorRequest;
use App\TaskTime\ApplicationService\DTO\TaskTimeStoperRequest;
use App\TaskTime\ApplicationService\FinishedTaskFinder;
use App\TaskTime\ApplicationService\TaskTimeInitiator;
use App\TaskTime\ApplicationService\TaskTimeStoper;
use App\TaskTime\ApplicationService\UnfinishedTaskFinder;
use App\TaskTime\Infrastructure\Framework\Form\Model\TimeFormModel;
use App\TaskTime\Infrastructure\Framework\Form\TimeFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

final class TaskTimeController extends SymfonyWebController
{
    public function __construct(
        private readonly UnfinishedTaskFinder $unfinishedTaskFinder,
        private readonly TaskTimeInitiator $taskTimeInitiator,
        private readonly TaskTimeStoper $taskTimeStoper,
        private readonly FinishedTaskFinder $finishedTaskFinder
    ) {
    }

    #[Route('/', name: 'app_task_time')]
    public function index(?TimeFormModel $timeFormModel, Request $request): Response
    {
        $model    = new TaskFormModel();
        $taskForm = $this->createForm(TaskFormType::class, $model);
        $taskForm->handleRequest($request);

        $timeForm = $this->createForm(TimeFormType::class, $timeFormModel);
        $timeForm->handleRequest($request);

        if ($taskForm->isSubmitted() && $taskForm->isValid()) {
            $response = ($this->unfinishedTaskFinder)($model->taskName());

            $unfinishedTask = $response->taskTime;

            $finishedTaskTimes = ($this->finishedTaskFinder)($model->taskName());

            $timeForm = $this->createForm(TimeFormType::class, new TimeFormModel());
            $timeForm->handleRequest($request);

            $this->saveTaskNameSessionVariable($request->getSession(), $response->task->name());

            return $this->render('task_time/index.html.twig', [
                'form' => $taskForm->createView(),
                'is_visible_time_form' => true,
                'timeForm' => $timeForm->createView(),
                'task_time' => $unfinishedTask,
                'finished_task_times' => $finishedTaskTimes->items(),
                'amount_hours_task_time' => $finishedTaskTimes->totalTaskTime(),
            ]);
        }

        if ($timeForm->isSubmitted() && $timeForm->isValid()) {
            $taskName = $request->getSession()->get(SessionVariable::TASK_NAME);

            if ($timeForm->get('start')->isClicked()) {
                $task = ($this->taskTimeInitiator)(new TaskTimeInitiatorRequest($taskName));
            }

            if ($timeForm->get('end')->isClicked()) {
                $task = ($this->taskTimeStoper)(new TaskTimeStoperRequest($taskName));
            }

            $finishedTaskTimes = ($this->finishedTaskFinder)($taskName);

            return $this->render('task_time/index.html.twig', [
                'form' => $taskForm->createView(),
                'is_visible_time_form' => true,
                'timeForm' => $timeForm->createView(),
                'task_time' => $timeForm->get('end')->isClicked() ? null : $task,
                'finished_task_times' => $finishedTaskTimes->items(),
                'amount_hours_task_time' => $finishedTaskTimes->totalTaskTime(),
            ]);
        }

        return $this->render('task_time/index.html.twig', [
            'form' => $taskForm->createView(),
            'is_visible_time_form' => false,
            'timeForm' => null === $timeFormModel ? null : $timeForm->createView(),
            'task_time' => null,
            'finished_task_times' => [],
        ]);
    }

    private function saveTaskNameSessionVariable(Session $session, string $taskName): void
    {
        $session->set(SessionVariable::TASK_NAME, $taskName);
    }
}
