<?php

namespace Modules\Carts\tests\Unit;

use Modules\Carts\app\Services\CartSessionService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartSessionServiceTest extends TestCase
{


    private CartSessionService $cartSessionService;

    protected function setUp(): void
    {
        $this->cartSessionService = new CartSessionService();
    }

    public function testAdd()
    {
        $productId = 1;
        $name = 'Product 1';
        $quantity = 2;

        $this->cartSessionService->add($productId, $name, $quantity);

        $items = $this->cartSessionService->getItems();

        $this->assertArrayHasKey($productId, $items);
        $this->assertEquals($name, $items[$productId]['name']);
        $this->assertEquals($quantity, $items[$productId]['quantity']);
    }

    public function testGetItems()
    {
        $productId = 1;
        $name = 'Product 1';
        $quantity = 2;

        $this->cartSessionService->add($productId, $name, $quantity);

        $items = $this->cartSessionService->getItems();

        $this->assertEquals([$productId => ['id' => $productId, 'name' => $name, 'quantity' => $quantity]], $items);
    }

    public function testRemoveItem()
    {
        $productId = 1;
        $name = 'Product 1';
        $quantity = 2;

        $this->cartSessionService->add($productId, $name, $quantity);

        $this->cartSessionService->removeItem($productId);

        $items = $this->cartSessionService->getItems();

        $this->assertArrayNotHasKey($productId, $items);
    }

    public function testUpdateQuantity()
    {
        $productId = 1;
        $name = 'Product 1';
        $quantity = 2;
        $newQuantity = 3;

        $this->cartSessionService->add($productId, $name, $quantity);

        $this->cartSessionService->updateQuantity($productId, $newQuantity);

        $items = $this->cartSessionService->getItems();

        $this->assertEquals($newQuantity, $items[$productId]['quantity']);
    }
}
