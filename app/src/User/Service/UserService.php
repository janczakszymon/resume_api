<?php

declare(strict_types=1);

namespace App\User\Service;

use App\User\Api\Dto\CreateUserDto;
use App\User\Api\Dto\UpdateUserPasswordDto;
use App\User\Api\Dto\UpdateUserRolesDto;
use App\User\Entity\User;
use App\User\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final readonly class UserService
{
    public function __construct(
        private UserRepository              $repository,
        private UserPasswordHasherInterface $hasher,

    )
    {
    }

    public function save(CreateUserDto $dto): User
    {
        $user = new User();
        $hashedPassword = $this->hasher->hashPassword(
            $user,
            $dto->password
        );

        $user->setRoles($dto->roles);
        $user->setUsername($dto->username);
        $user->setPassword($hashedPassword);

        $this->repository->save($user, true);

        return $user;
    }

    public function updateRoles(User $user, UpdateUserRolesDto $dto): User
    {
        $user->setRoles($dto->roles);

        $this->repository->save($user, true);

        return $user;
    }

    public function updatePassword(User $user, UpdateUserPasswordDto $dto): ?User
    {
        if (
            !$this->hasher->isPasswordValid($user, $dto->oldPassword)
            || ($dto->newPassword !== $dto->confirmNewPassword)
        ) {
            return null;
        }

        $hashedPassword = $this->hasher->hashPassword(
            $user,
            $dto->newPassword
        );

        $user->setPassword($hashedPassword);

        $this->repository->save($user, true);

        return $user;
    }

    public function remove(User $user): void
    {
        $this->repository->remove($user, true);
    }
}