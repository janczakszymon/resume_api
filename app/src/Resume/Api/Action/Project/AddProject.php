<?php

declare(strict_types=1);

namespace App\Resume\Api\Action\Project;

use App\Resume\Api\Dto\CreateProjectDto;
use App\Resume\Api\Serializer\ProjectSerializer;
use App\Resume\Service\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class AddProject extends AbstractController
{
    public function __construct(
        private readonly ProjectService    $service,
        private readonly ProjectSerializer $serializer,
    )
    {
    }

    #[Route(path: '/projects', name: 'add_project', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] CreateProjectDto $dto
    ): JsonResponse
    {
        $project = $this->service->saveProject($dto);

        return new JsonResponse(
            $this->serializer->serialize($project),
            Response::HTTP_CREATED
        );
    }
}