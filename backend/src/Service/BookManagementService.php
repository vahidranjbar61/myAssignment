<?php

namespace App\Service;

use App\Entity\BookManagement;
use App\Repository\BookManagementRepository;
use App\Repository\BookRepository;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BookManagementService
{
    const FREE = 'free';
    const BORROWED = 'borrowed';
    private BookRepository $bookRepository;
    private BookManagementRepository $bookManagementRepository;
    private UserRepository $userRepository;

    public function __construct(
        BookRepository $bookRepository,
        BookManagementRepository $bookManagementRepository,
        UserRepository $userRepository
    ) {
        $this->bookRepository = $bookRepository;
        $this->bookManagementRepository = $bookManagementRepository;
        $this->userRepository = $userRepository;
    }

    public function borrowBook(int $userId, int $bookId): JsonResponse {
        $user = $this->userRepository->find(['id' => $userId]);
        $book = $this->bookRepository->find(['id' => $bookId]);

        $bookManagement = $this->bookManagementRepository->findOneBy([
            'book' => $bookId
        ]);
        $userHasOtherBookBorrowed = $this->userHasOtherBookBorrowed($userId);


        if ($bookManagement === null) {
            if ($userHasOtherBookBorrowed) {
                return new JsonResponse(['message' => 'You have another book borrowed'], Response::HTTP_OK);
            }
            // Add a new record to BookManagement table
            $newBookManagement = new BookManagement();
            $newBookManagement->setBook($book);
            $newBookManagement->setUser($user);
            $newBookManagement->setBookingDate(new DateTimeImmutable('now'));

            $this->bookManagementRepository->save($newBookManagement);

            // Update status to borrowed
            $book->setStatus(self::BORROWED);
            $this->bookRepository->save($book);

            return new JsonResponse(['message' => 'You borrowed the book "' . $book->getTitle() . '"'], Response::HTTP_OK);
        }

        if ($book->getStatus() === self::FREE) {
            if ($userHasOtherBookBorrowed) {
                return new JsonResponse(['message' => 'You have another book borrowed'], Response::HTTP_OK);
            }
            $bookManagement->setUser($user);
            $bookManagement->setBookingDate(new DateTimeImmutable('now'));
            $this->bookManagementRepository->save($bookManagement);

            // Update status to borrowed
            $book->setStatus(self::BORROWED);
            $this->bookRepository->save($book);

            return new JsonResponse(['message' => 'You borrowed the book "' . $book->getTitle() . '"'], Response::HTTP_OK);
        }

        return new JsonResponse(['message' => 'The book "' . $book->getTitle() . '" is already borrowed.'], Response::HTTP_OK);
    }

    private function userHasOtherBookBorrowed(int $userId): bool
    {
        $bookManagement = $this->bookManagementRepository->findOneBy([
            'user' => $userId
        ]);

        return !($bookManagement === null);
    }

    public function releaseBook(int $userId, int $bookId): JsonResponse {
        $book = $this->bookRepository->find($bookId);
        $bookManagement = $this->bookManagementRepository->findOneBy([
            'user' => $userId,
            'book' => $bookId
        ]);

        if ($bookManagement !== null && $userId === $bookManagement->getUser()->getId()) {
            if ($book->getStatus() === self::BORROWED) {
                // Remove the BookManagement record
                $this->bookManagementRepository->remove($bookManagement);

                // Update status of the Book
                $book->setStatus(self::FREE);
                $this->bookRepository->save($book);

                return new JsonResponse(['message' => 'You returned the book "' . $book->getTitle() . '"'], Response::HTTP_OK);
            }

            return new JsonResponse(['message' => 'The book "' . $book->getTitle() . '" is already free to borrow.'], Response::HTTP_OK);
        }

        if ($book->getStatus() === self::FREE) {
            return new JsonResponse(['message' => 'The book "' . $book->getTitle() . '" is already free to borrow.'], Response::HTTP_OK);
        }

        return new JsonResponse(['message' => 'You can not free the book "' . $book->getTitle() . '"'], Response::HTTP_OK);
    }
}