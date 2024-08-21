<?php

declare(strict_types=1);

namespace App\Resume\Api\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class UpdateProjectDto extends CreateProjectDto
{
    #[Assert\NotNull]
    public int $id;
}