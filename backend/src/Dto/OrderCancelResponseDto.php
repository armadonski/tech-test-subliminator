<?php

declare(strict_types=1);

namespace App\Dto;

class OrderCancelResponseDto
{
    private array $result = [];
    private array $error = [];

    public function getResult(): array
    {
        return $this->result;
    }

    public function setResult(array $result): OrderCancelResponseDto
    {
        $this->result = $result;

        return $this;
    }

    public function getError(): array
    {
        return $this->error;
    }

    public function setError(array $error): OrderCancelResponseDto
    {
        $this->error = $error;

        return $this;
    }

    public function serialize(): array
    {
        return [
            'result' => $this->result,
            'errors' => $this->error
        ];
    }
}
