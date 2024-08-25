<?php

declare(strict_types=1);

namespace App\Resume\Api\Action\Project;

use App\Resume\Api\Serializer\ProjectSerializer;
use App\Resume\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GetProjects extends AbstractController
{
    public function __construct(
        private readonly ProjectRepository $repository,
        private readonly ProjectSerializer $serializer,
    )
    {
    }

    #[Route(path: '/projects/', name: 'get_projects', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        $projects = [];

        foreach ($this->repository->findAll() as $project) {
            $projects[] = $this->serializer->serialize($project);
        }

        return new JsonResponse(
            $projects,
            Response::HTTP_OK,
        );
    }
}