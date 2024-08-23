<?php

declare(strict_types=1);

namespace App\Resume\Api\Action\Technology;

use App\Resume\Repository\TechnologyRepository;
use App\Resume\Service\TechnologyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DeleteTechnology extends AbstractController
{
    public function __construct(
        private readonly TechnologyService    $service,
        private readonly TechnologyRepository $repository,
    )
    {
    }

    #[Route(path: '/technologies/{id}', name: 'delete_technology', methods: ['DELETE'])]
    public function __invoke(
        int $id
    ): JsonResponse
    {
        $technology = $this->repository->findOneBy(['id' => $id]);

        if (!$technology) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        $this->service->removeTechnology($technology);

        return new JsonResponse([], Response::HTTP_OK);
    }
}