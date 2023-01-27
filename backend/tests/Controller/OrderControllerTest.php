<?php

declare(strict_types=1);

namespace Test\Controller;

use App\Controller\OrderController;
use App\Dto\OrderRequestDto;
use App\Service\OrderService;
use PHPUnit\Framework\TestCase;
use PHPUnit\Util\Json;
use Symfony\Component\HttpFoundation\JsonResponse;

class OrderControllerTest extends TestCase
{
    private OrderController $controller;
    private OrderRequestDto $requestDto;
    private OrderService $service;

    protected function setUp(): void
    {
        $this->requestDto = $this->createMock(OrderRequestDto::class);
        $this->service = $this->createMock(OrderService::class);

        $this->controller = new OrderController();
    }

    public function testCanGetOrdersWithSuccess()
    {
        $response = new JsonResponse();

        $this->service
            ->expects($this->once())
            ->method('get')
            ->willReturn($response);

        $result = $this->controller->getOrderList($this->requestDto, $this->service);
        $this->assertEquals($response, $result);
    }
}
