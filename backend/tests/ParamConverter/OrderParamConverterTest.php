<?php

declare(strict_types=1);

namespace Test\ParamConverter;

use App\Dto\OrderRequestDto;
use App\ParamConverter\OrderParamConverter;
use PHPUnit\Framework\TestCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class OrderParamConverterTest extends TestCase
{
    private OrderParamConverter $converter;
    private Request $request;
    private ParamConverter $config;

    protected function setUp(): void
    {
        $this->request = $this->createMock(Request::class);
        $this->config = $this->createMock(ParamConverter::class);

        $this->converter = new OrderParamConverter();
    }

    public function testCanGetOrderClass()
    {

        $this->config
            ->expects($this->once())
            ->method('getClass')
            ->willReturn(OrderRequestDto::class);

        $result = $this->converter->supports($this->config);

        $this->assertTrue($result);
    }

    public function testCanApplyDataFromRequest()
    {
        $paramBag = $this->createMock(ParameterBag::class);
        $paramBag
            ->expects($this->exactly(2))
            ->method('get')
            ->willReturnOnConsecutiveCalls(1, 1);

        $this->request->attributes = $paramBag;

        $paramBag
            ->expects($this->once())
            ->method('set');

        $this->config
            ->expects($this->once())
            ->method('getName')
            ->willReturn('test');

        $this->request->query = $paramBag;

        $this->converter->apply($this->request, $this->config);
    }
}
