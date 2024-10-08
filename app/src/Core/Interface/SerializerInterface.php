<?php

declare(strict_types=1);

namespace App\Core\Interface;

interface SerializerInterface
{
    /** @return array<string, string> */
    public function serialize(object $object): array;
}