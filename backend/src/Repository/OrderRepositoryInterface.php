<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\OrderImportItemDto;
use App\Entity\Order;

interface OrderRepositoryInterface
{
    public function get();

    /** @var OrderImportItemDto[] $orderDtos */
    public function insertMultiple(array $orderDtos);

    public function updateStatus(Order $order, string $status);
    public function find(int $orderId);
}