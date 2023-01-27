<?php

declare(strict_types=1);

namespace App\Validator;

use App\Dto\OrderRequestDto;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderRequestValidator
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(OrderRequestDto $requestDto): array
    {
        $errorMessages = [];
        $violations = $this->validator->validate($requestDto);

        if (0 !== $violations->count()) {
            foreach ($violations as $violation) {
                /** @var ConstraintViolation $violation */
                $errorMessages[] = $violation->getMessage();
            }
        }

        return $errorMessages;
    }
}
