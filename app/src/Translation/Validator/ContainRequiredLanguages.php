<?php

declare(strict_types=1);

namespace App\Translation\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ContainRequiredLanguages extends Constraint
{
    public string $missing = "Missing translation for language '{{ language }}'";
    public string $tooMany = "Too many translations for language {{ language }}'";

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}