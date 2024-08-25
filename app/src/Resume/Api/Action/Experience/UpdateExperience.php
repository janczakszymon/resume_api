<?php

declare(strict_types=1);

namespace App\Resume\Api\Action\Experience;

use App\Resume\Api\Dto\ExperienceDto;
use App\Resume\Api\Serializer\ExperienceSerializer;
use App\Resume\Repository\ExperienceRepository;
use App\Resume\Service\ExperienceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class UpdateExperience extends AbstractController
{
    public function __construct(
        private readonly ExperienceService    $service,
        private readonly ExperienceRepository $repository,
        private readonly ExperienceSerializer $serializer
    )
    {
    }

    #[Route(path: '/experiences/{id}/', name: 'update_experience', methods: ['PUT'])]
    public function __invoke(
        int                                $id,
        #[MapRequestPayload] ExperienceDto $dto
    ): JsonResponse
    {
        $experience = $this->repository->findOneBy(['id' => $id]);

        if (!$experience) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(
            $this->serializer->serialize($this->service->update($experience, $dto)),
            Response::HTTP_OK
        );
    }
}