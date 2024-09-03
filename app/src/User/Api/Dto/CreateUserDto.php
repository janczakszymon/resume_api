<?php

declare(strict_types=1);

namespace App\User\Api\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class CreateUserDto
{
    #[Assert\NotBlank]
    public string $username;

    #[Assert\NotBlank]
    public string $password;

    #[Assert\NotNull]
    public array $roles;
}