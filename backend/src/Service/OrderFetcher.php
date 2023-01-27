<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\OrderRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class OrderFetcher implements OrderFetcherInterface
{
    private OrderRepository $orderRepository;

    /**
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getPaginated($page = 1, $items = 10): array
    {
        $query = $this->orderRepository->get($page, $items);

        $firstResult = $items * ($page - 1);
        $paginator = new Paginator($query);
        $paginator->getQuery()
            ->setFirstResult($firstResult)
            ->setMaxResults($items);

        $total = $paginator->count();
        $lastPage = (int)ceil($paginator->count() / $paginator
                ->getQuery()
                ->getMaxResults());

        return [
            $paginator
                ->getQuery()
                ->getArrayResult(),
            $total,
            $lastPage
        ];
    }
}
