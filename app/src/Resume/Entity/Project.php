<?php

declare(strict_types=1);

namespace App\Resume\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'project')]
final class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private array $name = [];

    #[ORM\Column]
    private array $fullName = [];

    #[ORM\Column]
    private array $description = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): array
    {
        return $this->name;
    }

    public function setName(array $name): void
    {
        $this->name = $name;
    }

    public function getFullName(): array
    {
        return $this->fullName;
    }

    public function setFullName(array $fullName): void
    {
        $this->fullName = $fullName;
    }

    public function getDescription(): array
    {
        return $this->description;
    }

    public function setDescription(array $description): void
    {
        $this->description = $description;
    }
}
