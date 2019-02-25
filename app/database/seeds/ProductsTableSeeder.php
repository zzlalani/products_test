<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Product::truncate();

        $json = File::get("database/data/products.json");
        $data = json_decode($json, true);
        foreach ($data as $product) {
            \App\Product::create($product);
        }
    }
}
