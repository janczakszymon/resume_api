<?php

declare(strict_types=1);

namespace App\Resume\Api\Action\Text;

use App\Resume\Api\Dto\TextDto;
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

    #[Route(path: '/texts/', name: 'add_text', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] TextDto $dto
    ): JsonResponse
    {
        $text = $this->service->save($dto);

        return new JsonResponse(
            $this->serializer->serialize($text),
            Response::HTTP_CREATED
        );
    }
}