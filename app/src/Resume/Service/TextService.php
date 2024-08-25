<?php

declare(strict_types=1);

namespace App\Resume\Service;

use App\Resume\Api\Dto\TextDto;
use App\Resume\Entity\Text;
use App\Resume\Repository\TextRepository;

final readonly class TextService
{
    public function __construct(
        private TextRepository $repository
    )
    {
    }

    public function save(TextDto $dto): Text
    {
        $newText = new Text();

        $newText->setTextPrimary($dto->textPrimary);
        $newText->setTextSecondary($dto->textSecondary);
        $newText->setSection($dto->section);

        $this->repository->save($newText, true);

        return $newText;
    }

    public function update(Text $text, TextDto $dto): Text
    {
        $text->setTextPrimary($dto->textPrimary);
        $text->setTextSecondary($dto->textSecondary);
        $text->setSection($dto->section);

        $this->repository->save($text, true);

        return $text;
    }

    public function remove(Text $text): void
    {
        $this->repository->remove($text, true);
    }
}