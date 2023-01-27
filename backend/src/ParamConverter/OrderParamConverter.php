<?php

declare(strict_types=1);

namespace App\ParamConverter;

use App\Dto\OrderRequestDto;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class OrderParamConverter implements ParamConverterInterface
{
    public function apply(Request $request, ParamConverter $configuration): void
    {
        $page = $request->query->get(OrderRequestDto::PAGE_PARAM);
        $items = $request->query->get(OrderRequestDto::ITEMS_PARAM);

        $requestDto = new OrderRequestDto($page, $items);

        $request->attributes->set($configuration->getName(), $requestDto);
    }

    public function supports(ParamConverter $configuration): bool
    {
        return $configuration->getClass() === OrderRequestDto::class;
    }
}
