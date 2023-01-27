<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\OrderRequestDto;
use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

#[Route('/api/order', name: 'order_controller')]
class OrderController extends AbstractController
{
    #[Route(
        '/get',
        name: 'order_list',
        requirements: ['page' => '\d+', 'items' => '\d+'],
        methods: ['GET']
    )
    ]
    #[ParamConverter(
        'request',
        class: OrderRequestDto::class
    )
    ]
    public function getOrderList(
        OrderRequestDto $request,
        OrderService $orderService
    ): JsonResponse {
        return $orderService->get($request);
    }

    public function cancelOrder()
    {

    }
}
