<?php

declare(strict_types=1);

namespace App\Translation\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class TranslationDto
{
    #[Assert\NotNull]
    public string $language;

    #[Assert\NotNull]
    public string $text;
}