<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;

class InvalidStatusException extends Exception
{
    public function __construct()
    {
        parent::__construct();
        $this->message = 'Only orders with status pending can be cancelled';
    }
}
