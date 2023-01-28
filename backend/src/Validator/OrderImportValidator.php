<?php

declare(strict_types=1);

namespace App\Validator;

use App\Dto\OrderImportItemDto;
use App\Exception\InvalidItemException;
use Symfony\Component\Validator\ConstraintViolation;

class OrderImportValidator extends AbstractValidator
{
    /**
     * @throws InvalidItemException
     * @var OrderImportItemDto[] $deserializedOrders
     */
    public function validateContents(array $deserializedOrders): void
    {
        foreach ($deserializedOrders as $requestDto) {
            $errorMessages = $this->getViolationMessages($requestDto);

            if (0 !== count($errorMessages)) {
                throw new InvalidItemException($errorMessages, $requestDto->serialize());
            }
        }
    }

    protected function getViolationFormat(ConstraintViolation $constraintViolation): string
    {
        return sprintf(
            '%s -> %s',
            $constraintViolation->getPropertyPath(),
            $constraintViolation->getMessage()
        );
    }
}
