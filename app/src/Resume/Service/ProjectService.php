<?php

declare(strict_types=1);

namespace App\Resume\Service;

use App\Resume\Api\Dto\CreateProjectDto;
use App\Resume\Api\Dto\UpdateProjectDto;
use App\Resume\Entity\Project;
use App\Resume\Repository\ProjectRepository;

final readonly class ProjectService
{
    public function __construct(
        private ProjectRepository $repository
    )
    {
    }

    public function saveProject(CreateProjectDto $dto): Project
    {
        $project = new Project();

        $project->setName($dto->name);
        $project->setFullName($dto->fullName);
        $project->setDescription($dto->description);

        $this->repository->save($project, true);

        return $project;
    }

    public function updateProject(Project $project, UpdateProjectDto $dto): Project
    {
        $project->setName($dto->name);
        $project->setFullName($dto->fullName);
        $project->setDescription($dto->description);

        $this->repository->save($project, true);

        return $project;
    }

    public function removeProject(Project $project): void
    {
        $this->repository->remove($project, true);
    }
}