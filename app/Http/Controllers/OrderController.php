<?php

namespace App\Http\Controllers;

use App\Exceptions\Order\OrderAlreadyProcessedException;
use App\Exceptions\Order\OrderNotFoundException;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\ProcessOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param CreateOrderRequest $request
     *
     * @return JsonResponse
     */
    public function createOrder(CreateOrderRequest $request): JsonResponse
    {
        $order = $this->orderService->createOrder($request->validated());

        return $this->sendResponse(data: $order, status: Response::HTTP_CREATED);
    }

    /**
     * @param int                 $id
     * @param ProcessOrderRequest $request
     *
     * @return JsonResponse
     * @throws OrderNotFoundException
     * @throws OrderAlreadyProcessedException
     */
    public function processOrder(int $id, ProcessOrderRequest $request)
    {
        $this->orderService->processOrder($id, $request->validated());

        return $this->sendResponse(message: 'Order is added to the queue for processing.');
    }
}
