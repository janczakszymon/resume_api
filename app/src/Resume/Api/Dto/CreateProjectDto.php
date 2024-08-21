<?php

declare(strict_types=1);

namespace App\Resume\Api\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class CreateProjectDto
{
    #[Assert\NotNull]
    public string $name;

    #[Assert\NotNull]
    public string $fullName;

    #[Assert\NotNull]
    public string $description;
}