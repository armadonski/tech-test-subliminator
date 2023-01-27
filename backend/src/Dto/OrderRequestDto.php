<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class OrderRequestDto
{
    public const DEFAULT_PAGE = 1;
    public const DEFAULT_NUMBER_OF_ITEMS = 10;
    public const PAGE_PARAM = 'page';
    public const ITEMS_PARAM = 'items';

    #[Assert\Type('numeric')]
    #[Assert\Positive]
    private mixed $page;

    #[Assert\Type('numeric')]
    #[Assert\Positive]
    private mixed $items;

    public function __construct(mixed $page, mixed $items)
    {
        $this->page = $page ?? self::DEFAULT_PAGE;
        $this->items = $items ?? self::DEFAULT_NUMBER_OF_ITEMS;
    }

    public function getPage(): int
    {
        return (int)$this->page;
    }

    public function getItems(): int
    {
        return (int)$this->items;
    }
}
