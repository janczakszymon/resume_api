<?php

declare(strict_types=1);

namespace App\Resume\Api\Action\Text;

use App\Resume\Enum\AvailableSectionsEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GetAvailableSections extends AbstractController
{
    public function __construct()
    {
    }

    #[Route(path: '/sections/', name: 'get_available_section', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        $sections = [];

        foreach (AvailableSectionsEnum::cases() as $section) {
            $sections[] = $section->value;
        }

        return new JsonResponse(
            $sections,
            Response::HTTP_OK,
        );
    }
}