<?php

declare(strict_types=1);

namespace App\Resume\Api\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class TechnologyDto
{
    #[Assert\NotBlank]
    public string $name;
}