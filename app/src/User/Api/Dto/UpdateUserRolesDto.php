<?php

declare(strict_types=1);

namespace App\User\Api\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserRolesDto
{
    /** @var array<string> $roles */
    #[Assert\NotNull]
    public array $roles;
}