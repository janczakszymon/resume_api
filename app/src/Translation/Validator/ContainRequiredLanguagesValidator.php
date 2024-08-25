<?php

declare(strict_types=1);

namespace App\Translation\Validator;

use App\Translation\Dto\TranslationDto;
use App\Translation\Enum\LanguagesToCheck;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ContainRequiredLanguagesValidator extends ConstraintValidator
{
    /** @var TranslationDto[] $value */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof ContainRequiredLanguages) {
            throw new UnexpectedTypeException($constraint, ContainRequiredLanguages::class);
        }

        $containTranslations = [];

        foreach ($value as $translation) {
            if (
                !is_subclass_of($translation, TranslationDto::class)
                && !($translation instanceof TranslationDto)
            ) {
                throw new UnexpectedTypeException($constraint, TranslationDto::class);
            }

            $containTranslations[] = $translation->language;
        }

        foreach (LanguagesToCheck::cases() as $case) {
            if (!in_array($case->value, $containTranslations)) {
                $this->context->buildViolation($constraint->missing)
                    ->setParameter('{{ language }}', $case->value)
                    ->addViolation();
            }
        }

        foreach (array_count_values($containTranslations) as $language => $count) {
            if ($count > 1) {
                $this->context->buildViolation($constraint->tooMany)
                    ->setParameter('{{ language }}', $language)
                    ->addViolation();
            }
        }
    }
}