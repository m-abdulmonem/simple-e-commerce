<?php

namespace Modules\Carts\app\Services;

use Illuminate\Support\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CartSessionService implements CartBaseService
{
    private const SESSION_KEY = "carts.items";

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function add(int $productId, string $name = null, int $quantity = 1): string|array|null|int|\stdClass
    {
        $items = $this->getItems();

        if (isset($items[$productId])) {
            $items[$productId]['quantity'] += $quantity;
        } else {
            $items[$productId] = [
                'id' => $productId,
                'quantity' => $quantity,
                'name' => $name
            ];
        }

        session()->put(self::SESSION_KEY, $items);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getItems(bool $returnCart = false): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|array
    {
        return session()->get(self::SESSION_KEY, []);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function removeItem(int $productId): ?bool
    {
        $items = $this->getItems();

        if (isset($items[$productId])) {

            unset($items[$productId]);
        }
        session()->put(self::SESSION_KEY, $items);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function updateQuantity (int $productId, int $value, bool $increment = true): void
    {
        $items = $this->getItems();

        if (isset($items[$productId])) {

            if ($value <= 0) {
                unset($items[$productId]);
            } else {

                $items[$productId]['quantity'] += $increment ? $value : -$value;;
            }
        }

        session()->put(self::SESSION_KEY, $items);
    }
}
