<?php

declare(strict_types=1);

namespace App\Core\Validator;

use ReflectionEnum;
use ReflectionException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class EnumChoiceValidator extends ConstraintValidator
{
    /**
     * @param string $value
     * @throws ReflectionException
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof EnumChoice) {
            throw new UnexpectedTypeException($constraint, EnumChoice::class);
        }

        $enum = new ReflectionEnum($constraint->enum);
        $enumValues = array_column($enum->getConstants(), 'value');

        if (!in_array($value, $enumValues)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ choice }}', $value)
                ->addViolation();
        }
    }
}