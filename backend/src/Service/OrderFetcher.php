<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\OrderRepository;

class OrderFetcher
{
    private OrderRepository $orderRepository;

    /**
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function get($page = 1, $items = 10)
    {
        return $this->orderRepository->get($page, $items);
    }
}
