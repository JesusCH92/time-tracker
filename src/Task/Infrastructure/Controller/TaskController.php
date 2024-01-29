<?php

declare(strict_types=1);

namespace App\Task\Infrastructure\Controller;

use App\Common\Infrastructure\Framework\SymfonyWebController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class TaskController extends SymfonyWebController
{
    #[Route('/task', name: 'app_find_task')]
    public function findTask(Request $request): JsonResponse
    {
        return new JsonResponse([['id' => 1, 'text' => 'uno'], ['id' => 2, 'text' => 'dos']]);
    }
}
