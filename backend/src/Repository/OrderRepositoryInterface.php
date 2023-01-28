<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dto\OrderImportItemDto;

interface OrderRepositoryInterface
{
    public function get();

    /** @var OrderImportItemDto[] $orderDtos */
    public function insertMultiple(array $orderDtos);
}