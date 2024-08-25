<?php

declare(strict_types=1);

namespace App\Resume\Api\Action\Technology;

use App\Resume\Api\Serializer\TechnologySerializer;
use App\Resume\Repository\TechnologyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GetTechnologies extends AbstractController
{
    public function __construct(
        private readonly TechnologyRepository $repository,
        private readonly TechnologySerializer $serializer,
    )
    {
    }

    #[Route(path: '/technologies/', name: 'get_technologies', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        $technologies = [];

        foreach ($this->repository->findAll() as $technology) {
            $technologies[] = $this->serializer->serialize($technology);
        }

        return new JsonResponse(
            $technologies,
            Response::HTTP_OK,
        );
    }
}