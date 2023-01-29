<?php

declare(strict_types=1);

namespace App\Service;

interface OrderFetcherInterface
{
    public function getPaginated(int $page, int $items): array;

    public function findById(int $orderId);
}