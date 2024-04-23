<?php

namespace App\Controller;

use App\Dto\BookDto;
use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    const SEARCH_QUERY = 'searchQuery';
    private BookRepository $bookRepository;

    public function __construct(
        BookRepository $bookRepository
    ) {
        $this->bookRepository = $bookRepository;
    }


    /** @Route("/books", methods={"GET"}) */
    public function getAllBooks(): JsonResponse
    {
        // Get the authenticated user object from Security
        $user = $this->getUser();
        // Check if user is authenticated
        if (!$user) {
            return new JsonResponse(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $books = $this->bookRepository->findAll();

        return new JsonResponse($this->mapToDto($books));
    }

    /** @Route("/books/search", methods={"GET"}) */
    public function searchAction(Request $request): JsonResponse
    {
        // Get the authenticated user object from Security
        $user = $this->getUser();
        // Check if user is authenticated
        if (!$user) {
            return new JsonResponse(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $searchQuery = $request->query->get(self::SEARCH_QUERY);
        $sanitizedQuery = htmlspecialchars($searchQuery, ENT_QUOTES);

        $books = $this->bookRepository->searchBooks($sanitizedQuery);

        return new JsonResponse($this->mapToDto($books));
    }

    /**
     * @param Book[] $books
     * @return BookDto[]
     */
    private function mapToDto(array $books): array
    {
        return  array_map(
            function (Book $book) {
                return (new BookDto(
                    $book->getId(),
                    $book->getTitle(),
                    $book->getAuthor(),
                    $book->getDate(),
                    $book->getStatus()
                ))->toArray();
            },
            $books,
        );
    }
}