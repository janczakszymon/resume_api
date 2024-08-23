<?php

declare(strict_types=1);

namespace App\Resume\Api\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class TechnologyDto
{
    #[Assert\NotNull]
    public string $name;
}