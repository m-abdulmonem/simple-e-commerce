<?php

namespace Modules\Orders\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Auth\app\Models\User;
use Modules\Carts\app\Models\Cart;
use Modules\Carts\app\Models\CartItem;
use Modules\Orders\Database\factories\OrderFactory;
use Modules\Products\app\Models\Product;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable =['cart_id', 'user_id', 'status'];


    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function items()
    {
        return $this->hasManyThrough(Product::class, CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function newFactory(): OrderFactory
    {
        //return OrderFactory::new();
    }
}
