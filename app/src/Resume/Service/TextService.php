<?php

declare(strict_types=1);

namespace App\Resume\Service;

use App\Resume\Api\Dto\CreateTextDto;
use App\Resume\Api\Dto\UpdateTextDto;
use App\Resume\Entity\Text;
use App\Resume\Repository\TextRepository;

final readonly class TextService
{
    public function __construct(
        private TextRepository $repository
    )
    {
    }

    public function saveText(CreateTextDto $dto): Text
    {
        $newText = new Text();

        $newText->setTextPrimary($dto->textPrimary);
        $newText->setTextSecondary($dto->textSecondary);
        $newText->setLanguage($dto->language);
        $newText->setSection($dto->section);

        $this->repository->save($newText, true);

        return $newText;
    }

    public function updateText(Text $text, UpdateTextDto $dto): Text
    {
        $text->setTextPrimary($dto->textPrimary);
        $text->setTextSecondary($dto->textSecondary);
        $text->setLanguage($dto->language);
        $text->setSection($dto->section);

        $this->repository->save($text, true);

        return $text;
    }

    public function removeText(Text $text): void
    {
        $this->repository->remove($text, true);
    }
}