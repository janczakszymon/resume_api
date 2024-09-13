<?php

declare(strict_types=1);

namespace App\Core\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class EnumChoice extends Constraint
{
    public string $enum;

    public string $message = "Choice '{{ choice }}' is incorrect";

    /**
     * @param string $enum
     * @param array<mixed>|null $groups
     * @param mixed|null $payload
     * @param array<mixed> $options
     */
    public function __construct(
        string $enum,
        ?array $groups = null,
        mixed  $payload = null,
        array  $options = [])
    {
        $options['value'] = $enum;

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