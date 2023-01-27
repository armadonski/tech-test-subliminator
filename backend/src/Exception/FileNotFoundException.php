<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;
use Throwable;

class FileNotFoundException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $this->message = "No files found in the requested directory";

        parent::__construct($message, $code, $previous);
    }
}
