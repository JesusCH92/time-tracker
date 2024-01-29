<?php

declare(strict_types=1);

namespace App\Task\Domain\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(name: 'name', type: Types::STRING, length: 255, nullable: false)]
    private ?string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
