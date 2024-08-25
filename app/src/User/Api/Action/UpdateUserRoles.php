<?php

declare(strict_types=1);

namespace App\User\Api\Action;

use App\User\Api\Dto\UpdateUserRolesDto;
use App\User\Api\Serializer\UserSerializer;
use App\User\Repository\UserRepository;
use App\User\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class UpdateUserRoles extends AbstractController
{
    public function __construct(
        private readonly UserService    $service,
        private readonly UserRepository $repository,
        private readonly UserSerializer $serializer
    )
    {
    }

    #[Route(path: '/{id}/roles/', name: 'update_user_roles', methods: ['PUT'])]
    public function __invoke(
        int                                     $id,
        #[MapRequestPayload] UpdateUserRolesDto $dto
    ): JsonResponse
    {
        $user = $this->repository->findOneBy(['id' => $id]);

        if (!$user) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(
            $this->serializer->serialize($this->service->updateRoles($user, $dto)),
            Response::HTTP_OK
        );
    }
}