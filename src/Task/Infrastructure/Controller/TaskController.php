<?php

declare(strict_types=1);

namespace App\Task\Infrastructure\Controller;

use App\Common\Infrastructure\Framework\SymfonyWebController;
use App\Task\ApplicationService\AllTaskGetter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class TaskController extends SymfonyWebController
{
    public function __construct(private readonly AllTaskGetter $allTaskGetter)
    {
    }

    #[Route('/task', name: 'app_find_task')]
    public function findTask(Request $request): JsonResponse
    {
        $query = $request->get('q', '');

        $tasks = ($this->allTaskGetter)($query);

        return new JsonResponse($tasks->mappingDropdown());
    }
}
