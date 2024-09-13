<?php

declare(strict_types=1);

namespace App\Resume\Entity;

use App\Translation\Dto\TranslationDto;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'resume')]
class Text
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 254)]
    private ?string $section = null;

    /** @var array<TranslationDto> $textPrimary */
    #[ORM\Column]
    private array $textPrimary = [];

    /** @var array<TranslationDto> $textSecondary */
    #[ORM\Column]
    private array $textSecondary = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getSection(): ?string
    {
        return $this->section;
    }

    public function setSection(?string $section): void
    {
        $this->section = $section;
    }

    /** @return  array<TranslationDto> */
    public function getTextPrimary(): array
    {
        return $this->textPrimary;
    }

    /** @param array<TranslationDto> $textPrimary */
    public function setTextPrimary(array $textPrimary): void
    {
        $this->textPrimary = $textPrimary;
    }

    /** @return  array<TranslationDto> */
    public function getTextSecondary(): array
    {
        return $this->textSecondary;
    }

    /** @param array<TranslationDto> $textSecondary */
    public function setTextSecondary(array $textSecondary): void
    {
        $this->textSecondary = $textSecondary;
    }
}
