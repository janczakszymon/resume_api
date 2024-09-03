<?php

declare(strict_types=1);

namespace App\Translation\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class TranslationDto
{
    #[Assert\NotBlank]
    public string $language;

    #[Assert\NotBlank]
    public string $text;
}