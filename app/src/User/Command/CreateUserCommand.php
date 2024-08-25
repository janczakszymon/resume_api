<?php

declare(strict_types=1);

namespace App\User\Command;

use App\User\Entity\User;
use App\User\Repository\UserRepository;
use Random\RandomException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:create-admin-user',
    description: 'Creates a new admin user.',
    aliases: ['app:add-user'],
    hidden: false
)]
class CreateUserCommand extends Command
{
    public function __construct(
        private readonly UserRepository              $repository,
        private readonly UserPasswordHasherInterface $hasher,
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $adminUsername = "admin";
        $plaintextPassword = self::randomPassword();

        if ($this->repository->findOneBy(['username' => $adminUsername])) {
            $output->writeln([
                "Admin account ($adminUsername) already exists.",
            ]);

            return Command::FAILURE;
        }

        $output->writeln([
            "Creating admin user with username '$adminUsername'",
            "password: $plaintextPassword"
        ]);

        $user = new User();

        $hashedPassword = $this->hasher->hashPassword(
            $user,
            $plaintextPassword
        );

        $user->setPassword($hashedPassword);
        $user->setUsername($adminUsername);
        $user->setRoles(['ROLE_ADMIN']);

        $this->repository->save($user, true);

        return Command::SUCCESS;
    }

    /**
     * @throws RandomException
     */
    private function randomPassword(): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}