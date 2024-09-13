<?php

declare(strict_types=1);

namespace App\Core\Serializer;

use App\Translation\Dto\TranslationDto;

class BaseSerializer
{
    /**
     * @param array<TranslationDto> $translations
     * @return array<string, string>
     * */
    protected function formatTranslations(array $translations): array
    {
        return array_column($translations, 'text', 'language');
    }
}