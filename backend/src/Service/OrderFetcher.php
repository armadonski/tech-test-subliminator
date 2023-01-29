<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Order;
use App\Repository\OrderRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Tools\Pagination\Paginator;

class OrderFetcher implements OrderFetcherInterface
{
    public function __construct(private readonly OrderRepositoryInterface $orderRepository)
    {
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
            $paginator->getQuery()->getArrayResult(),
            $total,
            $lastPage
        ];
    }

    public function findById(int $orderId): Order
    {
        $order = $this->orderRepository->find($orderId);

        if (null === $order) {
            throw new EntityNotFoundException(sprintf('Order with id %s cannot be found', $orderId));
        }

        return $order;
    }
}
