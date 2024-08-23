<?php

declare(strict_types=1);

namespace App\Resume\Api\Serializer;

use App\Core\Interface\SerializerInterface;
use App\Resume\Entity\Technology;

final readonly class TechnologySerializer implements SerializerInterface
{
    public function serialize(object $object): array
    {
        if (!($object instanceof Technology)) {
            return [];
        }

        return [
            'id' => $object->getId(),
            'name' => $object->getName(),
        ];
    }
}