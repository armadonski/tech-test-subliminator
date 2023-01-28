<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\OrderImportService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

#[AsCommand(
    name: 'app:import-orders',
    description: 'Imports order from a JSON file',
    hidden: false
)]
class ImportOrdersCommand extends Command
{
    public function __construct(private readonly OrderImportService $importOrderService)
    {
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $response = Command::SUCCESS;

        try {
            $this->importOrderService->handle();

            $output->writeln('Import finished with success');
        } catch (Throwable $t) {
            $output->writeln($t->getMessage());

            $response = Command::FAILURE;
        }

        return $response;
    }
}
