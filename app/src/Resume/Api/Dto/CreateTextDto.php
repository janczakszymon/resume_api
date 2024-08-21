<?php

declare(strict_types=1);

namespace App\Resume\Api\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class CreateTextDto
{
    #[Assert\NotNull]
    public string $textPrimary;

    #[Assert\NotNull]
    public string $textSecondary;

    #[Assert\NotNull]
    public string $language;

    #[Assert\NotNull]
    public string $section;
}