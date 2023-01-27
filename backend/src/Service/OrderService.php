<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\OrderListResponseDto;
use App\Dto\OrderRequestDto;
use App\Validator\OrderRequestValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class OrderService
{
    private OrderRequestValidator $validator;
    private OrderFetcherInterface $orderFetcher;

    public function __construct(
        OrderRequestValidator $validator,
        OrderFetcherInterface $orderFetcher
    ) {
        $this->validator = $validator;
        $this->orderFetcher = $orderFetcher;
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

    public function delete()
    {

    }
}
