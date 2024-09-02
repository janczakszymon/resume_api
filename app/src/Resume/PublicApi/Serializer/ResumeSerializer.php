<?php

declare(strict_types=1);

namespace App\Resume\PublicApi\Serializer;

use App\Core\Serializer\BaseSerializer;
use App\Resume\Entity\Experience;
use App\Resume\Entity\Project;
use App\Resume\Entity\Technology;
use App\Resume\Entity\Text;
use DateTimeInterface;

final class ResumeSerializer extends BaseSerializer
{
    /**
     * @param Text[] $texts
     * @param Experience[] $experiences
     * @param Project[] $projects
     * @param Technology[] $technologies
     */
    public function serialize(
        array $texts,
        array $experiences,
        array $projects,
        array $technologies,
    ): array
    {
        $values = [
            'texts' => [],
            'experiences' => [],
            'projects' => [],
            'technologies' => [],
        ];

        foreach ($texts as $text) {
            $values['texts'][$text->getSection()][] = $this->serializeText($text);
        }

        foreach ($experiences as $experience) {
            $values['experiences'][] = $this->serializeExperience($experience);
        }

        foreach ($projects as $project) {
            $values['projects'][] = $this->serializeProject($project);
        }

        foreach ($technologies as $technology) {
            $values['technologies'][] = $this->serializeTechnology($technology);
        }

        return $values;
    }

    private function serializeText(object $object): array
    {
        if (!($object instanceof Text)) {
            return [];
        }

        return [
            'textPrimary' => self::formatTranslations($object->getTextPrimary()),
            'textSecondary' => self::formatTranslations($object->getTextSecondary()),
        ];
    }

    private function serializeExperience(object $object): array
    {
        if (!($object instanceof Experience)) {
            return [];
        }

        return [
            'company' => $object->getCompany(),
            'location' => $object->getLocation(),
            'position' => self::formatTranslations($object->getPosition()),
            'startDate' => $object->getStartDate()->format(DateTimeInterface::ATOM),
            'endDate' => $object->getEndDate()?->format(DateTimeInterface::ATOM),
        ];
    }

    private function serializeTechnology(object $object): array
    {
        if (!($object instanceof Technology)) {
            return [];
        }

        return [
            'name' => $object->getName(),
        ];
    }

    private function serializeProject(object $object): array
    {
        if (!($object instanceof Project)) {
            return [];
        }

        return [
            'id' => $object->getId(),
            'name' => $object->getName()
        ];
    }
}