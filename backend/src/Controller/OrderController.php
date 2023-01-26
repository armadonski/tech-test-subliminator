<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\OrderFetcher;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route(
        'api/get-orders',
        name: 'order_list',
        requirements: ['page' => '\d+', 'noOfItems' => '\d+'],
        methods: ['GET']
    )
    ]
    public function getOrder(Request $request, OrderFetcher $orderFetcher): JsonResponse
    {
        $page = $request->query->getInt('page');
        $noOfItems = $request->query->getInt('noOfItems');

        $query = $orderFetcher->get($page, $noOfItems);
        $firstResult = $noOfItems * ($page - 1);
        $paginator = new Paginator($query);
        $paginator->getQuery()
            ->setFirstResult($firstResult)
            ->setMaxResults($noOfItems);
        $total = $paginator->count();
        $lastPage = (int)ceil($paginator->count() / $paginator->getQuery()->getMaxResults());
        $items = $paginator;
        $response = new JsonResponse($items->getQuery()->getArrayResult());
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    public function cancelOrder()
    {

    }
}
