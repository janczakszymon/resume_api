<?php

declare(strict_types=1);

namespace App\Resume\Api\Serializer;

use App\Core\Interface\SerializerInterface;
use App\Resume\Entity\Experience;
use DateTimeInterface;

final readonly class ExperienceSerializer implements SerializerInterface
{
    public function serialize(object $object): array
    {
        if (!($object instanceof Experience)) {
            return [];
        }

        return [
            'id' => $object->getId(),
            'company' => $object->getCompany(),
            'location' => $object->getLocation(),
            'position' => $object->getPosition(),
            'startDate' => $object->getStartDate()->format(DateTimeInterface::ATOM),
            'endDate' => $object->getEndDate()->format(DateTimeInterface::ATOM),
        ];
    }
}