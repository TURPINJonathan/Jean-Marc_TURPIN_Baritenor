<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Event>
 *
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

    public function findEventsByType($type)
    {
        return $this->createQueryBuilder('e')
            ->leftJoin('e.eventPlace', 'ep')
            ->leftJoin('ep.eventType', 'et')
            ->where('et.label = :type')
            ->orderBy('e.startAt', 'DESC')
            ->setParameter('type', $type)
            ->getQuery()
            ->getResult();
    }

    public function findEventsByPlace($place)
    {
        return $this->createQueryBuilder('e')
            ->join('e.eventPlace', 'ep')
            ->where('ep.city = :place')
            ->orderBy('e.startAt', 'DESC')
            ->setParameter('place', $place)
            ->getQuery()
            ->getResult();
    }

    public function findEventsByMonth($month, $year)
    {
        $startDate = new \DateTime($year . '-' . $month . '-01T00:00:00Z');
        $endDate = (clone $startDate)->modify('last day of this month')->modify('23:59:59');

        $queryBuilder = $this->createQueryBuilder('e')
            ->where('e.startAt BETWEEN :start_date AND :end_date')
            ->orderBy('e.startAt', 'DESC')
            ->setParameters([
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
            ]);

        $query = $queryBuilder->getQuery();

        $result = $query->getResult();

        if (empty($result)) {
            throw new NoResultException('Aucun événement trouvé pour le mois, l\'année et le lieu spécifiés.');
        }

        return $result;
    }

    public function findEventsByName($name)
    {
        return $this->createQueryBuilder('e')
            ->where('e.name LIKE :name')
            ->orderBy('e.startAt', 'DESC')
            ->addOrderBy('e.name', 'ASC')
            ->setParameter('name', '%' . $name . '%')
            ->getQuery()
            ->getResult();
    }
}
