<?php

declare(strict_types=1);

namespace App\Dto;

class OrderListResponseDto
{
    private array $result = [];
    private array $items = [];
    private int $total;
    private int $lastPage;
    private array $errors = [];

    public function getResult(): array
    {
        return $this->result;
    }

    public function setResult(array $result): OrderListResponseDto
    {
        $this->result = $result;

        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): OrderListResponseDto
    {
        $this->items = $items;

        return $this;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function setTotal(int $total): OrderListResponseDto
    {
        $this->total = $total;

        return $this;
    }

    public function getLastPage(): int
    {
        return $this->lastPage;
    }

    public function setLastPage(int $lastPage): OrderListResponseDto
    {
        $this->lastPage = $lastPage;

        return $this;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors(array $errors): OrderListResponseDto
    {
        $this->errors = $errors;

        return $this;
    }

    public function serialize(): array
    {
        return [
            'result' => [
                'items'    => $this->items,
                'total'    => $this->total,
                'lastPage' => $this->lastPage
            ],
            'errors' => $this->errors
        ];
    }
}
