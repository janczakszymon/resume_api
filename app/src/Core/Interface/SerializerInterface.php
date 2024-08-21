<?php

declare(strict_types=1);

namespace App\Core\Interface;

interface SerializerInterface
{
    public function serialize(object $object): array;
}