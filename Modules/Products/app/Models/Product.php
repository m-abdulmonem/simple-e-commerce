<?php

namespace Modules\Products\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Carts\app\Models\Cart;
use Modules\Products\Database\factories\ProductFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'quantity',
        'image'
    ];

    /**
     * @author Mohamed Abdelmonem <mabdulalmonem@gmail.com>
     *
     * The cart method defines a "has many" relationship between the current model and the Cart model.
     *
     * This method is used to retrieve all carts that are associated with the current model.
     * The relationship is defined through the "product_id" foreign key in the Cart model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany A "has many" relationship instance.
     *
     */
    public function carts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Cart::class, "product_id");
    }

    /**
     *
     * @return ProductFactory
     */
    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }
}
