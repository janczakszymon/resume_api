<?php

declare(strict_types=1);

namespace App\Resume\Api\Action\Project;

use App\Resume\Api\Dto\ProjectDto;
use App\Resume\Api\Serializer\ProjectSerializer;
use App\Resume\Repository\ProjectRepository;
use App\Resume\Service\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class UpdateProject extends AbstractController
{
    public function __construct(
        private readonly ProjectService    $service,
        private readonly ProjectRepository $repository,
        private readonly ProjectSerializer $serializer
    )
    {
    }

    #[Route(path: '/projects/{id}', name: 'update_project', methods: ['PUT'])]
    public function __invoke(
        int                             $id,
        #[MapRequestPayload] ProjectDto $dto
    ): JsonResponse
    {
        $project = $this->repository->findOneBy(['id' => $id]);

        if (!$project) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(
            $this->serializer->serialize($this->service->updateProject($project, $dto)),
            Response::HTTP_OK
        );
    }
}