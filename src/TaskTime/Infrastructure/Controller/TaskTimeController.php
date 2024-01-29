<?php

declare(strict_types=1);

namespace App\TaskTime\Infrastructure\Controller;

use App\Common\Infrastructure\Framework\SymfonyWebController;
use App\Task\Infrastructure\Framework\Form\Model\TaskFormModel;
use App\Task\Infrastructure\Framework\Form\TaskFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class TaskTimeController extends SymfonyWebController
{
    #[Route('/', name: 'app_task_time')]
    public function index(Request $request): Response
    {
        $model = new TaskFormModel();
        $form = $this->createForm(TaskFormType::class, $model);
        $form->handleRequest($request);

        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
            'form' => $form->createView(),
        ]);
    }
}
