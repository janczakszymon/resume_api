<?php

declare(strict_types=1);

namespace App\Resume\PublicApi\Action;

use App\Resume\PublicApi\Serializer\ResumeProjectSerializer;
use App\Resume\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GetProjectById extends AbstractController
{
    public function __construct(
        private readonly ProjectRepository       $projectRepository,
        private readonly ResumeProjectSerializer $projectSerializer
    )
    {
    }

    #[Route(path: '/projects/${id}/', name: 'get_resume_project_by_id', methods: ['GET'])]
    public function __invoke(int $id): JsonResponse
    {
        $project = $this->projectRepository->findOneBy(['id' => $id]);

        if (!$project) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(
            $this->projectSerializer->serialize($project),
            Response::HTTP_OK,
        );
    }
}