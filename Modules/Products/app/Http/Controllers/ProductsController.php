<?php

namespace Modules\Products\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Modules\Products\app\Models\Product;
use Modules\Products\app\Resources\ProductResource;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : AnonymousResourceCollection
    {
        return ProductResource::collection(Product::paginate(9))->additional([
            'msg' => __('Retrieve 10 Products'),
            'status' => 'success'
        ]);
    }

    /**
     * Show the specified resource.
     */
    public function show(Product $product): \Illuminate\Http\JsonResponse
    {
//        $product->load([
//            "carts" => fn($q) => $q->where('user_id', auth()->id())
//        ]);

        return json(
            new ProductResource($product),
            message: __('Retrieve 10 Products')
        );
    }
}
