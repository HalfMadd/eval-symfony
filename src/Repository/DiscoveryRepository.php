<?php

namespace App\Repository;

use App\Entity\Discovery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Discovery|null find($id, $lockMode = null, $lockVersion = null)
 * @method Discovery|null findOneBy(array $criteria, array $orderBy = null)
 * @method Discovery[]    findAll()
 * @method Discovery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiscoveryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Discovery::class);
    }

	public function test():Query
	{
		$results = $this->createQueryBuilder('discovery')
			->select('COUNT(discovery.id), country.name')
			->join('discovery.country', 'country')
			->groupBy('country.name')

			->getQuery()
		;

		return $results;
    }

    // public function find4():Query
    // {
    // 	$results = $this->createQueryBuilder('discovery')
    // 	->select('image')
    // 	->setMaxResults(4)

    // 	->getQuery()
    // 	;

    // 	return $results;
    // }
}
