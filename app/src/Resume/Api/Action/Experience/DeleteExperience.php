<?php

declare(strict_types=1);

namespace App\Resume\Api\Action\Experience;

use App\Resume\Repository\ExperienceRepository;
use App\Resume\Service\ExperienceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DeleteExperience extends AbstractController
{
    public function __construct(
        private readonly ExperienceService    $service,
        private readonly ExperienceRepository $repository,
    )
    {
    }

    #[Route(path: '/experiences/{id}', name: 'delete_experience', methods: ['DELETE'])]
    public function __invoke(
        int $id
    ): JsonResponse
    {
        $experience = $this->repository->findOneBy(['id' => $id]);

        if (!$experience) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        $this->service->removeExperience($experience);

        return new JsonResponse([], Response::HTTP_OK);
    }
}