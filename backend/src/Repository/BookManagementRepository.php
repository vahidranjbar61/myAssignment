<?php

namespace App\Repository;

use App\Entity\BookManagement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BookManagement>
 *
 * @method BookManagement|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookManagement|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookManagement[]    findAll()
 * @method BookManagement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookManagementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookManagement::class);
    }

    public function remove(BookManagement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function save(BookManagement $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }
}
