<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function save(Book $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    /** @return Book[] */
    public function searchBooks(?string $searchQuery): array
    {
        $qb = $this->createQueryBuilder('qb');
        $qb->select('b')
            ->from(Book::class, 'b');
        if ($searchQuery !== null) {
            $searchTerms = explode(' ', trim($searchQuery));
            $orX = $qb->expr()->orX();
            foreach ($searchTerms as $i => $searchTerm) {
                $orX->add($qb->expr()->like('b.title', ':searchTerm_' . $i));
                $orX->add($qb->expr()->like('b.author', ':searchTerm_' . $i));
                $qb->setParameter('searchTerm_' . $i, '%' . $searchTerm . '%');
            }

            $qb->where($orX);
        }
        $query = $qb->getQuery();

        return $query->getResult();
    }
}
