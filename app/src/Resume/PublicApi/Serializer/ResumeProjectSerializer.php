<?php

declare(strict_types=1);

namespace App\Resume\PublicApi\Serializer;

use App\Core\Interface\SerializerInterface;
use App\Core\Serializer\BaseSerializer;
use App\Resume\Entity\Project;

class ResumeProjectSerializer extends BaseSerializer implements SerializerInterface
{
    public function serialize(object $object): array
    {
        if (!($object instanceof Project)) {
            return [];
        }

        return [
            'id' => $object->getId(),
            'name' => self::formatTranslations($object->getName()),
            'fullName' => self::formatTranslations($object->getFullName()),
            'description' => self::formatTranslations($object->getDescription()),
            'type' => $object->getType(),
        ];
    }
}