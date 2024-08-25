<?php

declare(strict_types=1);

namespace App\Resume\Api\Dto;

use App\Translation\Dto\TranslationDto;
use Symfony\Component\Validator\Constraints as Assert;
use App\Translation\Validator as TranslationAssert;

final class ProjectDto
{
    /** @var TranslationDto[] $name */
    #[Assert\Valid]
    #[TranslationAssert\ContainRequiredLanguages]
    public array $name = [];

    /** @var TranslationDto[] $fullName */
    #[Assert\Valid]
    #[TranslationAssert\ContainRequiredLanguages]
    public array $fullName = [];

    /** @var TranslationDto[] $description */
    #[Assert\Valid]
    #[TranslationAssert\ContainRequiredLanguages]
    public array $description = [];
}