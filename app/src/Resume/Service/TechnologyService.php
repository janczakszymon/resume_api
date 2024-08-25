<?php

declare(strict_types=1);

namespace App\Resume\Service;

use App\Resume\Api\Dto\TechnologyDto;
use App\Resume\Entity\Technology;
use App\Resume\Repository\TechnologyRepository;

final readonly class TechnologyService
{
    public function __construct(
        private TechnologyRepository $repository
    )
    {
    }

    public function save(TechnologyDto $dto): Technology
    {
        $technology = new Technology();

        $technology->setName($dto->name);

        $this->repository->save($technology, true);

        return $technology;
    }

    public function update(Technology $technology, TechnologyDto $dto): Technology
    {
        $technology->setName($dto->name);

        $this->repository->save($technology, true);

        return $technology;
    }

    public function remove(Technology $technology): void
    {
        $this->repository->remove($technology, true);
    }
}