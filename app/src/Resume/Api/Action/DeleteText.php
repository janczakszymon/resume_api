<?php

declare(strict_types=1);

namespace App\Resume\Api\Action;

use App\Resume\Repository\TextRepository;
use App\Resume\Service\TextService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DeleteText extends AbstractController
{
    public function __construct(
        private readonly TextService    $service,
        private readonly TextRepository $repository,
    )
    {
    }

    #[Route(path: '/{id}', name: 'delete_text', methods: ['DELETE'])]
    public function __invoke(
        int $id
    ): JsonResponse
    {
        $text = $this->repository->findOneBy(['id' => $id]);

        if (!$text) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        $this->service->removeText($text);

        return new JsonResponse([], Response::HTTP_OK);
    }
}