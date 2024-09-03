<?php

declare(strict_types=1);

namespace App\Resume\Api\Dto;

use App\Resume\Enum\AvailableSectionsEnum;
use App\Translation\Dto\TranslationDto;
use Symfony\Component\Validator\Constraints as Assert;
use App\Translation\Validator as TranslationAssert;
use App\Core\Validator as CoreAssert;

final class TextDto
{
    #[Assert\NotBlank]
    #[CoreAssert\EnumChoice(enum: AvailableSectionsEnum::class)]
    public string $section;

    /** @var TranslationDto[] $textPrimary */
    #[Assert\Valid]
    #[TranslationAssert\ContainRequiredLanguages]
    public array $textPrimary = [];

    /** @var TranslationDto[] $textSecondary */
    #[Assert\NotBlank]
    #[TranslationAssert\ContainRequiredLanguages]
    public array $textSecondary = [];
}