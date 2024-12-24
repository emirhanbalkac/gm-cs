<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Services\OrderService;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(CreateOrderRequest $request)
    {
        $order = $this->orderService->createOrder($request->validated());

        return $this->sendResponse(data: $order, status: Response::HTTP_CREATED);
    }
}
