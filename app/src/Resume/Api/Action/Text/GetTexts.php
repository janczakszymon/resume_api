<?php

declare(strict_types=1);

namespace App\Resume\Api\Action\Text;

use App\Resume\Api\Serializer\TextSerializer;
use App\Resume\Repository\TextRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GetTexts extends AbstractController
{
    public function __construct(
        private readonly TextRepository $repository,
        private readonly TextSerializer $serializer,
    )
    {
    }

    #[Route(path: '/texts/', name: 'get_texts', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        $texts = [];

        foreach ($this->repository->findAll() as $text) {
            $texts[] = $this->serializer->serialize($text);
        }

        return new JsonResponse(
            $texts,
            Response::HTTP_OK,
        );
    }
}