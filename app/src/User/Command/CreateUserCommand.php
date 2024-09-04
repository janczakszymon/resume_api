<?php

declare(strict_types=1);

namespace App\User\Command;

use App\User\Entity\User;
use App\User\Repository\UserRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Console\Input\InputArgument;

#[AsCommand(
    name: 'app:create-user',
    description: 'Creates a new user.',
    aliases: ['app:create-user'],
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

    protected function configure()
    {
        $this
            ->addArgument('username', InputArgument::REQUIRED, 'The username of the user.')
            ->addArgument('password', InputArgument::REQUIRED, 'The password of the user.')
            ->addArgument('role', InputArgument::REQUIRED, 'The role of the user.');
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $username = $input->getArgument('username');
        $plaintextPassword = $input->getArgument('password');

        if ($this->repository->findOneBy(['username' => $username])) {
            $output->writeln([
                "Account ($username) already exists.",
            ]);

            return Command::FAILURE;
        }

        $output->writeln([
            "Creating user with username '$username'",
            "password: $plaintextPassword"
        ]);

        $user = new User();

        $hashedPassword = $this->hasher->hashPassword(
            $user,
            $plaintextPassword
        );

        $user->setPassword($hashedPassword);
        $user->setUsername($username);
        $user->setRoles([$input->getArgument('role')]);

        $this->repository->save($user, true);

        return Command::SUCCESS;
    }
}