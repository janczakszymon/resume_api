<?php

declare(strict_types=1);

namespace App\User\Api\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class UpdateUserPasswordDto
{
    #[Assert\NotBlank]
    public string $oldPassword;

    #[Assert\NotBlank]
    public string $newPassword;

    #[Assert\NotBlank]
    public string $confirmNewPassword;
}