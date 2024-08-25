<?php

declare(strict_types=1);

namespace App\User\Api\Action;

use App\User\Repository\UserRepository;
use App\User\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DeleteUser extends AbstractController
{
    public function __construct(
        private readonly UserService    $service,
        private readonly UserRepository $repository,
    )
    {
    }

    #[Route(path: '/{id}/', name: 'delete_user', methods: ['DELETE'])]
    public function __invoke(
        int $id
    ): JsonResponse
    {
        $user = $this->repository->findOneBy(['id' => $id]);

        if (!$user) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        $this->service->remove($user);

        return new JsonResponse([], Response::HTTP_OK);
    }
}