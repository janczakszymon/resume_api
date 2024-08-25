<?php

declare(strict_types=1);

namespace App\Resume\PublicApi\Action;

use App\Resume\PublicApi\Serializer\ResumeSerializer;
use App\Resume\Repository\ExperienceRepository;
use App\Resume\Repository\ProjectRepository;
use App\Resume\Repository\TechnologyRepository;
use App\Resume\Repository\TextRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GetResume extends AbstractController
{
    public function __construct(
        private readonly ProjectRepository    $projectRepository,
        private readonly ExperienceRepository $experienceRepository,
        private readonly TechnologyRepository $technologyRepository,
        private readonly TextRepository       $textRepository,
        private readonly ResumeSerializer     $resumeSerializer,
    )
    {
    }

    #[Route(path: '/', name: 'get_resume', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(
            $this->resumeSerializer->serialize(
                $this->textRepository->findAll(),
                $this->experienceRepository->findAll(),
                $this->projectRepository->findAll(),
                $this->technologyRepository->findAll()
            ),
            Response::HTTP_OK,
        );
    }
}