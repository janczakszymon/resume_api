<?php

declare(strict_types=1);

namespace App\Resume\Api\Action\Text;

use App\Resume\Api\Dto\TextDto;
use App\Resume\Api\Serializer\TextSerializer;
use App\Resume\Repository\TextRepository;
use App\Resume\Service\TextService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class UpdateText extends AbstractController
{
    public function __construct(
        private readonly TextService    $service,
        private readonly TextRepository $repository,
        private readonly TextSerializer $serializer
    )
    {
    }

    #[Route(path: '/texts/{id}', name: 'update_text', methods: ['PUT'])]
    public function __invoke(
        int                          $id,
        #[MapRequestPayload] TextDto $dto
    ): JsonResponse
    {
        $text = $this->repository->findOneBy(['id' => $id]);

        if (!$text) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(
            $this->serializer->serialize($this->service->updateText($text, $dto)),
            Response::HTTP_OK
        );
    }
}