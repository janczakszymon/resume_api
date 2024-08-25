<?php

declare(strict_types=1);

namespace App\Resume\Enum;

enum AvailableSectionsEnum: string
{
    case ABOUT_ME = 'aboutMe';

    case STUDIES = 'studies';

    case LANGUAGES = 'languages';

    case CERTIFICATES = 'certificates';
}