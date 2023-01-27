<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Finder\Finder;

interface FileFinderInterface
{
    public function findJsonFiles(string $dirName);
}