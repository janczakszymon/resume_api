<?php

declare(strict_types=1);

namespace App\Resume\Entity;

use App\Translation\Dto\TranslationDto;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'project')]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /** @var array<TranslationDto> $name */
    #[ORM\Column]
    private array $name = [];

    /** @var array<TranslationDto> $fullName */
    #[ORM\Column]
    private array $fullName = [];

    /** @var array<TranslationDto> $description */
    #[ORM\Column]
    private array $description = [];

    #[ORM\Column(length: 254)]
    private ?string $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /** @return  array<TranslationDto> */
    public function getName(): array
    {
        return $this->name;
    }

    /** @param array<TranslationDto> $name */
    public function setName(array $name): void
    {
        $this->name = $name;
    }

    /** @return  array<TranslationDto> */
    public function getFullName(): array
    {
        return $this->fullName;
    }

    /** @param array<TranslationDto> $fullName */
    public function setFullName(array $fullName): void
    {
        $this->fullName = $fullName;
    }

    /** @return  array<TranslationDto> */
    public function getDescription(): array
    {
        return $this->description;
    }

    /** @param array<TranslationDto> $description */
    public function setDescription(array $description): void
    {
        $this->description = $description;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }
}
