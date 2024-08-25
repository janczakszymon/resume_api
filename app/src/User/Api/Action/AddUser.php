<?php

declare(strict_types=1);

namespace App\User\Api\Action;

use App\User\Api\Dto\CreateUserDto;
use App\User\Api\Serializer\UserSerializer;
use App\User\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class AddUser extends AbstractController
{
    public function __construct(
        private readonly UserService    $service,
        private readonly UserSerializer $serializer,
    )
    {
    }

    #[Route(path: '/', name: 'add_user', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] CreateUserDto $dto
    ): JsonResponse
    {
        $user = $this->service->save($dto);

        return new JsonResponse(
            $this->serializer->serialize($user),
            Response::HTTP_CREATED
        );
    }
}