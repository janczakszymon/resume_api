<?php

declare(strict_types=1);

namespace App\Resume\Api\Serializer;

use App\Core\Interface\SerializerInterface;
use App\Resume\Entity\Project;

final readonly class ProjectSerializer implements SerializerInterface
{
    public function serialize(object $object): array
    {
        if (!($object instanceof Project)) {
            return [];
        }

        return [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'fullName' => $object->getFullName(),
            'description' => $object->getDescription(),
        ];
    }
}