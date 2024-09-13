<?php

declare(strict_types=1);

namespace App\Resume\Entity;

use App\Translation\Dto\TranslationDto;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'experience')]
class Experience
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 254)]
    private ?string $company = null;

    /** @var array<TranslationDto> $position */
    #[ORM\Column]
    private array $position = [];

    #[ORM\Column(length: 254)]
    private ?string $location = null;

    #[ORM\Column(length: 254)]
    private ?\DateTime $startDate = null;

    #[ORM\Column(length: 254, nullable: true)]
    private ?\DateTime $endDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): void
    {
        $this->company = $company;
    }

    /** @return  array<TranslationDto> */
    public function getPosition(): array
    {
        return $this->position;
    }

    /** @param array<TranslationDto> $position */
    public function setPosition(array $position): void
    {
        $this->position = $position;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): void
    {
        $this->location = $location;
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }
}
