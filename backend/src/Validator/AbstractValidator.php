<?php

declare(strict_types=1);

namespace App\Validator;

use Exception;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractValidator
{
    public function __construct(protected readonly ValidatorInterface $validator)
    {
    }

    protected function getViolationMessages(object $object, ?Exception $exception = null): array
    {
        $errorMessages = [];
        $violations = $this->validator->validate($object);

        if (0 !== $violations->count()) {
            foreach ($violations as $violation) {
                /** @var ConstraintViolation $violation */
                $errorMessages[] = $this->getViolationFormat($violation);
            }
        }

        return $errorMessages;
    }

    protected function getViolationFormat(ConstraintViolation $constraintViolation): string
    {
        return $constraintViolation->getMessage();
    }
}
