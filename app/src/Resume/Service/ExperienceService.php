<?php

declare(strict_types=1);

namespace App\Resume\Service;

use App\Resume\Api\Dto\CreateExperienceDto;
use App\Resume\Api\Dto\UpdateExperienceDto;
use App\Resume\Entity\Experience;
use App\Resume\Repository\ExperienceRepository;

final readonly class ExperienceService
{
    public function __construct(
        private ExperienceRepository $repository
    )
    {
    }

    public function saveExperience(CreateExperienceDto $dto): Experience
    {
        $experience = new Experience();

        $experience->setCompany($dto->company);
        $experience->setLocation($dto->location);
        $experience->setPosition($dto->position);
        $experience->setStartDate($dto->startDate);
        $experience->setEndDate($dto->endDate);

        $this->repository->save($experience, true);

        return $experience;
    }

    public function updateExperience(Experience $experience, UpdateExperienceDto $dto): Experience
    {
        $experience->setCompany($dto->company);
        $experience->setLocation($dto->location);
        $experience->setPosition($dto->position);
        $experience->setStartDate($dto->startDate);
        $experience->setEndDate($dto->endDate);

        $this->repository->save($experience, true);

        return $experience;
    }

    public function removeExperience(Experience $experience): void
    {
        $this->repository->remove($experience, true);
    }
}