<?php

declare(strict_types=1);

namespace App\User\Api\Action;

use App\User\Api\Serializer\UserSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GetUserSession extends AbstractController
{
    function __construct(
        private readonly UserSerializer $serializer
    )
    {
    }

    #[Route(path: '/session/', name: 'get_user_session', methods: 'GET')]
    function __invoke(): JsonResponse
    {
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse([], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($this->serializer->serializeSession($user), Response::HTTP_OK);
    }
}