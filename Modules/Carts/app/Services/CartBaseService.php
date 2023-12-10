<?php

namespace Modules\Carts\app\Services;

use Illuminate\Support\Collection;

interface CartBaseService
{
    public function add(int $productId, string $name = null, int $quantity = 1): string|array|null|int|\stdClass;

    public function getItems(bool $returnCart = false): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|array;

    public function removeItem(int $productId): ?bool;

    public function updateQuantity (int $productId, int $value, bool $increment = true): void;
}
