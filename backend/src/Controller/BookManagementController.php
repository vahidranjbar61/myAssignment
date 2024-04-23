<?php

namespace App\Controller;

use App\Service\BookManagementService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class BookManagementController extends AbstractController
{
    private BookManagementService $bookManagementService;

    public function __construct(BookManagementService $bookManagementService) {
        $this->bookManagementService = $bookManagementService;
    }


    #[Route('/book/{bookId}/borrowBook/{userId}', methods: ['PUT'])]
    public function borrowAction(int $bookId, int $userId): JsonResponse
    {
        return $this->bookManagementService->borrowBook($userId, $bookId);
    }

    #[Route('/book/{bookId}/releaseBook/{userId}', methods: ['PUT'])]
    public function releaseAction(int $bookId, int $userId): JsonResponse
    {
        return $this->bookManagementService->releaseBook($userId, $bookId);
    }
}