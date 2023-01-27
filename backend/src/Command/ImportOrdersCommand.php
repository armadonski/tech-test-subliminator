<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\OrderImportService;
use Doctrine\DBAL\Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:import-orders',
    description: 'Imports order from a JSON file',
    hidden: false
)]
class ImportOrdersCommand extends Command
{
    private OrderImportService $importOrderService;

    public function __construct(OrderImportService $importOrderService)
    {
        parent::__construct();
        $this->importOrderService = $importOrderService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->importOrderService->handle();
        } catch (Exception $exception) {
            throw  $exception;
        }

        return Command::SUCCESS;
    }
}
