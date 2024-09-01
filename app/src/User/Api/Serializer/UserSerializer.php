<?php

declare(strict_types=1);

namespace App\User\Api\Serializer;

use App\Core\Interface\SerializerInterface;
use App\User\Entity\User;

final class UserSerializer implements SerializerInterface
{
    public function serialize(object $object): array
    {
        if (!$object instanceof User) {
            return [];
        }

        return [
            'id' => $object->getId(),
            'username' => $object->getUsername(),
            'roles' => $object->getRoles(),
        ];
    }

    public function serializeSession(object $object): array
    {
        if (!$object instanceof User) {
            return [];
        }

        return [
            'id' => $object->getId(),
            'username' => $object->getUsername(),
            'roles' => $object->getRoles()
        ];
    }
}