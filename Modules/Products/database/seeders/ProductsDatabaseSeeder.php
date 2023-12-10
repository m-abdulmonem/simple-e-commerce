<?php

namespace Modules\Products\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Products\app\Models\Product;

class ProductsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(15)->create();
    }
}
