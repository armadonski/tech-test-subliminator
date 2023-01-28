<?php

declare(strict_types=1);

namespace App\Validator;

use App\Dto\OrderRequestDto;

class OrderRequestValidator extends AbstractValidator
{
    public function validate(OrderRequestDto $requestDto): array
    {
        return $this->getViolationMessages($requestDto);
    }
}
