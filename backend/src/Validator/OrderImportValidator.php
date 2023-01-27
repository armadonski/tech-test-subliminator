<?php

declare(strict_types=1);

namespace App\Validator;

use App\Dto\OrderImportItemDto;
use App\Exception\InvalidItemException;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderImportValidator
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @throws InvalidItemException
     * @var OrderImportItemDto[] $deserializedOrders
     */
    public function validateContents(array $deserializedOrders): void
    {
        $errorMessages = [];

        foreach ($deserializedOrders as $item) {
            $violations = $this->validator->validate($deserializedOrders);

            if (0 !== $violations->count()) {
                foreach ($violations as $violation) {
                    /** @var ConstraintViolation $violation */
                    $errorMessages[] = sprintf(
                        '%s -> %s',
                        $violation->getPropertyPath(),
                        $violation->getMessage()
                    );
                }

                throw new InvalidItemException($errorMessages, $item->serialize());
            }
        }
    }
}
