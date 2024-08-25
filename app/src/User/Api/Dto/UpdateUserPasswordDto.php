<?php

declare(strict_types=1);

namespace App\User\Api\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class UpdateUserPasswordDto
{
    #[Assert\NotNull]
    public string $oldPassword;

    #[Assert\NotNull]
    public string $newPassword;

    #[Assert\NotNull]
    public string $confirmNewPassword;
}