<?php

namespace Modules\Carts\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Carts\app\Resources\CartResource;
use Modules\Products\app\Models\Product;

class CartsController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return json(
            new CartResource(cartService()->getItems(returnCart: true)),
            message: __('Load Cart product')
        );
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     */
    public function addToCart(Request $request,Product $product): JsonResponse
    {
        return json(
            cartService()->add(
                productId: $product->id,
                name: $product->name,
                quantity: $request->quantity ?? 1
            )
        );
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function deleteProductFromCart(Product $product): JsonResponse
    {
        return json(
            $result = cartService()->removeItem(productId: $product->id),
            message: $result ? __('Item Removed Successfully') : __('Can’t remove item')
        );
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     */
    public function updateQuantity(Request $request, Product $product): JsonResponse
    {
        cartService()->updateQuantity(
            productId: $product->id,
            value: $request->quantity,
            increment: $request->increment
        );

        return json(
            __('Product Quantity Updated Successfully')
        );
    }

}
