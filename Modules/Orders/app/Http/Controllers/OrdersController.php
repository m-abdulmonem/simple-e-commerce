<?php

namespace Modules\Orders\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use Modules\Auth\app\Models\User;
use Modules\Orders\app\Enums\OrderStatusEnum;
use Modules\Orders\app\Events\OrderNotifyEvent;
use Modules\Orders\app\Models\Order;
use Modules\Orders\app\Resources\OrderResource;

class OrdersController extends Controller
{

    /**
     * get order for admin
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return json(
            new OrderResource(Order::query()->latest()->orderBy("status", 'desc')->get()),
            message: __('Load Orders Successfully')
        );
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(): \Illuminate\Http\JsonResponse
    {
        $cartService = cartService();

        if (($cart = $cartService->getItems(returnCart: true))->items->isEmpty()) {
            return json(__('Cart is empty.'));
        }

        $order = Order::create([
            'cart_id' => $cart->id,
            'user_id' => auth()->id(),
            'status' => OrderStatusEnum::Pending->value
        ]);

        // Clear cart after successful order creation
        $cartService->clear();

        $details = [
            'title' => __('New order had been placed'),
            'order_id' => $order->id
        ];

        event(new OrderNotifyEvent($details, User::find(1)));

        return json(__('Order created successfully!'));
    }


}
