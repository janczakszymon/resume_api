<?php

declare(strict_types=1);

namespace App\User\Api\Action;

use App\User\Api\Serializer\UserSerializer;
use App\User\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GetUsers extends AbstractController
{
    public function __construct(
        private readonly UserRepository $repository,
        private readonly UserSerializer $serializer,
    )
    {
    }

    #[Route(path: '/', name: 'get_users', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        $users = [];

        foreach ($this->repository->findAll() as $user) {
            $users[] = $this->serializer->serialize($user);
        }

        return new JsonResponse(
            $users,
            Response::HTTP_OK,
        );
    }
}