<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function get($page = 1, $items = 10): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->where('o.deleted != :deletedStatus')
            ->orderBy('o.id', 'desc')
            ->setParameter('deletedStatus', 'No');
    }
}
