<?php

namespace App\Task\Infrastructure\Framework\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class TaskFormModel
{
    #[Assert\NotBlank]
    private $taskName;

    public function taskName()
    {
        return $this->taskName;
    }

    public function setTaskName($taskName)
    {
        $this->taskName = $taskName;
    }
}
