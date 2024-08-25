<?php

declare(strict_types=1);

namespace App\Resume\Api\Serializer;

use App\Core\Interface\SerializerInterface;
use App\Resume\Entity\Text;

final readonly class TextSerializer implements SerializerInterface
{
    public function serialize(object $object): array
    {
        if (!($object instanceof Text)) {
            return [];
        }

        return [
            'id' => $object->getId(),
            'textPrimary' => $object->getTextPrimary(),
            'textSecondary' => $object->getTextSecondary(),
            'section' => $object->getSection(),
        ];
    }
}