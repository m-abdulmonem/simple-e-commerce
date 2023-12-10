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
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $orders = Order::with(['user','cart.items.product'])
            ->latest()
            ->orderBy("status", 'desc')
            ->paginate(10);

        return OrderResource::collection($orders)->additional([
            'msg' => __('Retrieve 10 Orders'),
            'status' => 'success'
        ]);
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

        event(new OrderNotifyEvent($details));

        return json(__('Order created successfully!'));
    }


}
