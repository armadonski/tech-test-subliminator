<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\OrderCancelResponseDto;
use App\Dto\OrderListResponseDto;
use App\Dto\OrderRequestDto;
use App\Entity\Order;
use App\Repository\OrderRepositoryInterface;
use App\Validator\OrderRequestValidator;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class OrderService
{

    public function __construct(
        private readonly OrderRequestValidator $validator,
        private readonly OrderFetcherInterface $orderFetcher,
        private readonly OrderRepositoryInterface $orderRepository
    ) {
    }

    public function get(OrderRequestDto $request): JsonResponse
    {
        $dtoResponse = new OrderListResponseDto();
        $violations = $this->validator->validate($request);

        $page = $request->getPage();
        $items = $request->getItems();

        if (0 !== count($violations)) {
            $dtoResponse->setErrors($violations);

            return new JsonResponse(
                $dtoResponse->serialize(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        [$items, $total, $lastPage] = $this->orderFetcher
            ->getPaginated($page, $items);

        $dtoResponse
            ->setItems($items)
            ->setTotal($total)
            ->setLastPage($lastPage);

        return new JsonResponse($dtoResponse->serialize());
    }

    public function cancel(int $orderId): JsonResponse
    {
        $response = new JsonResponse();
        $responseDto = new OrderCancelResponseDto();

        try {
            $order = $this->orderFetcher->findById($orderId);
            $this->orderRepository->updateStatus($order, Order::STATUS_CANCELED);

            $responseDto->setResult([sprintf('Order %s updated with success', $orderId)]);
            $response->setData($responseDto->serialize());
        } catch (Exception $e) {
            $responseDto->setError([$e->getMessage()]);
            $response->setData($responseDto->serialize());
            $response->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $response;
    }
}
