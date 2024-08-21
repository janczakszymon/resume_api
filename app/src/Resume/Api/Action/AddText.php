<?php

declare(strict_types=1);

namespace App\Resume\Api\Action;

use App\Resume\Api\Dto\CreateTextDto;
use App\Resume\Api\Serializer\TextSerializer;
use App\Resume\Service\TextService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class AddText extends AbstractController
{
    public function __construct(
        private readonly TextService    $service,
        private readonly TextSerializer $serializer,
    )
    {
    }

    #[Route(path: '/', name: 'add_text', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] CreateTextDto $dto
    ): JsonResponse
    {
        $text = $this->service->saveText($dto);

        return new JsonResponse(
            $this->serializer->serialize($text),
            Response::HTTP_CREATED
        );
    }
}