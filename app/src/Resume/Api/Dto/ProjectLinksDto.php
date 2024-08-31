<?php

declare(strict_types=1);

namespace App\Resume\Api\Dto;

use App\Translation\Dto\TranslationDto;
use Symfony\Component\Validator\Constraints as Assert;
use App\Translation\Validator as TranslationAssert;

final class ProjectLinksDto
{
    /** @var TranslationDto[] $name */
    #[Assert\Valid]
    #[TranslationAssert\ContainRequiredLanguages]
    public array $name = [];

    #[Assert\NotNull]
    #[Assert\Type('string')]
    public string $address;

    #[Assert\NotNull]
    #[Assert\Type('string')]
    public string $icon;
}