<?php

declare(strict_types=1);

namespace App\Resume\Api\Action;

use App\Resume\Repository\ProjectRepository;
use App\Resume\Service\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DeleteProject extends AbstractController
{
    public function __construct(
        private readonly ProjectService    $service,
        private readonly ProjectRepository $repository,
    )
    {
    }

    #[Route(path: '/projects/{id}', name: 'delete_project', methods: ['DELETE'])]
    public function __invoke(
        int $id
    ): JsonResponse
    {
        $project = $this->repository->findOneBy(['id' => $id]);

        if (!$project) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        $this->service->removeProject($project);

        return new JsonResponse([], Response::HTTP_OK);
    }
}