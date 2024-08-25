<?php

declare(strict_types=1);

namespace App\Resume\Api\Action\Technology;

use App\Resume\Api\Dto\TechnologyDto;
use App\Resume\Api\Serializer\TechnologySerializer;
use App\Resume\Repository\TechnologyRepository;
use App\Resume\Service\TechnologyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class UpdateTechnology extends AbstractController
{
    public function __construct(
        private readonly TechnologyService    $service,
        private readonly TechnologyRepository $repository,
        private readonly TechnologySerializer $serializer
    )
    {
    }

    #[Route(path: '/technologies/{id}/', name: 'update_technology', methods: ['PUT'])]
    public function __invoke(
        int                                $id,
        #[MapRequestPayload] TechnologyDto $dto
    ): JsonResponse
    {
        $technology = $this->repository->findOneBy(['id' => $id]);

        if (!$technology) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(
            $this->serializer->serialize($this->service->update($technology, $dto)),
            Response::HTTP_OK
        );
    }
}