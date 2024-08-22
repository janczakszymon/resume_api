<?php

declare(strict_types=1);

namespace App\Resume\Api\Action\Experience;

use App\Resume\Api\Serializer\ExperienceSerializer;
use App\Resume\Repository\ExperienceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GetExperiences extends AbstractController
{
    public function __construct(
        private readonly ExperienceRepository $repository,
        private readonly ExperienceSerializer $serializer,
    )
    {
    }

    #[Route(path: '/experiences', name: 'get_experiences', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        $experiences = [];

        foreach ($this->repository->findAll() as $experience) {
            $experiences[] = $this->serializer->serialize($experience);
        }

        return new JsonResponse(
            $experiences,
            Response::HTTP_OK,
        );
    }
}