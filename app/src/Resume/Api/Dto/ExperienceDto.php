<?php

declare(strict_types=1);

namespace App\Resume\Api\Dto;

use App\Translation\Dto\TranslationDto;
use Symfony\Component\Validator\Constraints as Assert;
use App\Translation\Validator as TranslationAssert;

final class ExperienceDto
{
    #[Assert\NotNull]
    public string $company;

    #[Assert\NotNull]
    public string $location;

    #[Assert\NotNull]
    public \DateTime $startDate;

    public ?\DateTime $endDate = null;

    /** @var TranslationDto[] $position */
    #[Assert\Valid]
    #[TranslationAssert\ContainRequiredLanguages]
    public array $position = [];
}