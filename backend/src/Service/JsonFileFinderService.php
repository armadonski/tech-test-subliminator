<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\FileNotFoundException;
use Symfony\Component\Finder\Finder;

class JsonFileFinderService implements FileFinderInterface
{
    /**
     * @throws FileNotFoundException
     */
    public function findJsonFiles(string $dirName): Finder
    {
        $finder = (new Finder());
        $finder
            ->files()
            ->name('*.json')
            ->in($dirName);

        if (0 === $finder->count()) {
            throw new FileNotFoundException();
        }

        return $finder;
    }
}
