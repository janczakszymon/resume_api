<?php

declare(strict_types=1);

namespace App\Resume\Api\Action\Experience;

use App\Resume\Api\Dto\CreateExperienceDto;
use App\Resume\Api\Serializer\ExperienceSerializer;
use App\Resume\Service\ExperienceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class AddExperience extends AbstractController
{
    public function __construct(
        private readonly ExperienceService    $service,
        private readonly ExperienceSerializer $serializer,
    )
    {
    }

    #[Route(path: '/experiences', name: 'add_experience', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] CreateExperienceDto $dto
    ): JsonResponse
    {
        $experience = $this->service->saveExperience($dto);

        return new JsonResponse(
            $this->serializer->serialize($experience),
            Response::HTTP_CREATED
        );
    }
}