<?php

declare(strict_types=1);

namespace Test\Command;

use App\Command\ImportOrdersCommand;
use App\Service\OrderImportService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportOrdersCommandTest extends TestCase
{
    private ImportOrdersCommand $command;
    private OrderImportService $service;
    private InputInterface $input;
    private OutputInterface $output;

    protected function setUp(): void
    {
        $this->input = $this->createMock(InputInterface::class);
        $this->output = $this->createMock(OutputInterface::class);
        $this->service = $this->createMock(OrderImportService::class);

        $this->command = new ImportOrdersCommand($this->service);
    }

    public function testCanExecuteWithSuccess()
    {

        $this->service
            ->expects($this->once())
            ->method('handle');

        $this->output
            ->expects($this->once())
            ->method('writeln');

        $result = $this->command->execute($this->input, $this->output);
        $this->assertEquals(Command::SUCCESS, $result);
    }

    public function testCannotExecuteDueToException()
    {

        $this->service
            ->expects($this->once())
            ->method('handle')
            ->willThrowException(new \Exception());

        $this->output
            ->expects($this->once())
            ->method('writeln');

        $result = $this->command->execute($this->input, $this->output);
        $this->assertEquals(Command::FAILURE, $result);
    }
}
