<?php

declare(strict_types=1);

namespace App\Resume\Api\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class CreateExperienceDto
{
    #[Assert\NotNull]
    public string $company;

    #[Assert\NotNull]
    public string $location;

    #[Assert\NotNull]
    public string $position;

    #[Assert\NotNull]
    public \DateTime $startDate;

    #[Assert\NotNull]
    public \DateTime $endDate;
}