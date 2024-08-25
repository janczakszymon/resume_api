<?php

declare(strict_types=1);

namespace App\Core\Serializer;

class BaseSerializer
{
    protected function formatTranslations($translations): array
    {
        return array_column($translations, 'text', 'language');
    }
}