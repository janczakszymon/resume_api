<?php

declare(strict_types=1);

namespace App\Resume\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'resume')]
final class Text
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2)]
    private ?string $language = null;

    #[ORM\Column(length: 254)]
    private ?string $section = null;

    #[ORM\Column(length: 254)]
    private ?string $textPrimary = null;

    #[ORM\Column(length: 254)]
    private ?string $textSecondary = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): void
    {
        $this->language = $language;
    }

    public function getSection(): ?string
    {
        return $this->section;
    }

    public function setSection(?string $section): void
    {
        $this->section = $section;
    }

    public function getTextPrimary(): ?string
    {
        return $this->textPrimary;
    }

    public function setTextPrimary(?string $textPrimary): void
    {
        $this->textPrimary = $textPrimary;
    }

    public function getTextSecondary(): ?string
    {
        return $this->textSecondary;
    }

    public function setTextSecondary(?string $textSecondary): void
    {
        $this->textSecondary = $textSecondary;
    }
}
