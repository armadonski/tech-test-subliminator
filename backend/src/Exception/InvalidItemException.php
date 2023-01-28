<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;
use Throwable;

class InvalidItemException extends Exception
{
    public function __construct(array $violations, string $item)
    {
        $this->message = sprintf(
            'The following values are invalid: %s Errors found on item: %s',
            implode(', ', $violations),
            $item
        );

        parent::__construct();
    }
}
