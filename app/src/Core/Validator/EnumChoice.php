<?php

declare(strict_types=1);

namespace App\Core\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class EnumChoice extends Constraint
{
    public $enum;

    public string $message = "Choice '{{ choice }}' is incorrect";

    public function __construct(
        $enum,
        ?array $groups = null,
        $payload = null,
        array $options = [])
    {
        if (\is_array($enum)) {
            $options = array_merge($enum, $options);
        } elseif (null !== $enum) {
            $options['value'] = $enum;
        }

        parent::__construct($options, $groups, $payload);
    }

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }

    public function getDefaultOption(): string
    {
        return 'enum';
    }

    public function getRequiredOptions(): array
    {
        return ['enum'];
    }
}