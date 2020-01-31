<?php

namespace App\Repository;

use App\Entity\Campus;
use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function searchByName(string $search)
    {
        return $this->createQueryBuilder('e')
            ->andwhere('e.title LIKE :title')
            ->setParameter('title', '%'.$search.'%')
            ->getQuery()
            ->getResult();
    }

    public function findEventByCampus(?Campus $campus = null)
    {
        $qb = $this->createQueryBuilder('e')
            ->where('e.campus = :campus')
            ->setParameter('campus', $campus);
        if ($campus == empty([$qb])) {
            return $qb = $this->findBy([], ['date' => 'DESC']);
        }
        $qb->orderBy('e.date', 'ASC');
        return $qb->getQuery()->getResult();
    }
}
