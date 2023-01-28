<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;

class FileNotFoundException extends Exception
{
    public function __construct()
    {
        $this->message = "No files found in the requested directory";

        parent::__construct();
    }
}
