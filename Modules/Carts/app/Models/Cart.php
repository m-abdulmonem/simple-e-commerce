<?php

namespace Modules\Carts\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Carts\Database\factories\CartFactory;
use Modules\Products\app\Models\Product;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * @author Mohamed Abdelmonem <mabdulalmonem@gmail.com>
     *
     * The product method defines a "belongs to" relationship between the current model and the Product model.
     *
     * This method is used to retrieve the product that is associated with the current model.
     * The relationship is defined through the "product_id" foreign key in the Product model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo A "belongs to" relationship instance.
     *
     */
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    /**
     *
     * @return CartFactory
     */
    protected static function newFactory(): CartFactory
    {
        return CartFactory::new();
    }
}
