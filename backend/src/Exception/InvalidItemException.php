<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;
use Throwable;

class InvalidItemException extends Exception
{
    public function __construct(array $violations, string $item, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->message = sprintf(
            'The following values are invalid: %s Errors found on item: %s',
            implode(', ', $violations),
            $item
        );
    }
}
