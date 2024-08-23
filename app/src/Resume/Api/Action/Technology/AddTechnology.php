<?php

declare(strict_types=1);

namespace App\Resume\Api\Action\Technology;

use App\Resume\Api\Dto\TechnologyDto;
use App\Resume\Api\Serializer\TechnologySerializer;
use App\Resume\Service\TechnologyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class AddTechnology extends AbstractController
{
    public function __construct(
        private readonly TechnologyService    $service,
        private readonly TechnologySerializer $serializer,
    )
    {
    }

    #[Route(path: '/technologies', name: 'add_technology', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] TechnologyDto $dto
    ): JsonResponse
    {
        $technology = $this->service->save($dto);

        return new JsonResponse(
            $this->serializer->serialize($technology),
            Response::HTTP_CREATED
        );
    }
}