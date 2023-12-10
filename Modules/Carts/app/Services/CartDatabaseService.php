<?php

namespace Modules\Carts\app\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Modules\Carts\app\Enums\CartStatusEnum;
use Modules\Carts\app\Models\Cart;
use stdClass;

class CartDatabaseService implements CartBaseService
{
    /**
     * @param int $productId
     * @param string|null $name
     * @param int $quantity
     * @return string|array|int|stdClass|null
     */
    public function add(int $productId, string $name = null, int $quantity = 1): string|array|null|int|stdClass
    {
        $cart = $this->getCart();

        if ($existingItem = $cart->items->where('product_id', $productId)->first()) {
            $existingItem->quantity += $quantity;
            $existingItem->save();
            $message = __('Product exists and updated');
        } else {
            $cart->items()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
            $message = __('Product was add to cart successfully');
        }

        return $message;
    }

    /**
     * @return Builder|Model
     */
    private function getCart(): Builder|Model
    {
        return Cart::with("items")
            ->latest()
            ->where("status", CartStatusEnum::Draft->value)
            ->firstOrCreate(['user_id' => auth()->id()]);
    }

    /**
     * @param bool $returnCart
     * @return Builder|Model|array
     */
    public function getItems(bool $returnCart = false): Builder|Model|array
    {
        if ($returnCart) {
            return $this->getCart();
        }
        return $this->getCart()->items()->with('product')->get();
    }

    /**
     * @param int $productId
     * @return bool|null
     */
    public function removeItem(int $productId): ?bool
    {
        return $this->getCart()?->items()?->firstWhere("product_id", $productId)->delete();
    }

    /**
     * @param int $productId
     * @param int $value
     * @param bool $increment
     * @return void
     */
    public function updateQuantity(int $productId, int $value, bool $increment = true): void
    {
        $cart = $this->getCart();

        if ($item = $cart->items->where('product_id', $productId)->first()) {
            if ($value <= 0) {
                $item->delete();
            } else {
                ($q = ($increment ? $value : -$value) <= 0)
                    ? $item->delete()
                    : $item->update(['quantity' => $q]);
            }
        }
    }

    /**
     * @return void
     */
    public function clear(): void
    {
        $cart = $this->getCart();
        $cart->update([
            'status' => CartStatusEnum::Ordered->value
        ]);
    }
}
