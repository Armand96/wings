<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            array(
                'product_code' => "SKUSKLNPWG1",
                'product_name' => "SO Klin Pewangi",
                'price' => 15000,
                'currency' => 'IDR',
                'discount' => 15,
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS',
                'created_at' => date('Y-m-d'),
            ),
            array(
                'product_code' => "SKUSKLNPWG2",
                'product_name' => "SO Klin Liquid",
                'price' => 18000,
                'currency' => 'IDR',
                'discount' => 0,
                'dimension' => '15 cm x 10 cm',
                'unit' => 'PCS',
                'created_at' => date('Y-m-d'),
            ),
            array(
                'product_code' => "SKUSKLNPWG3",
                'product_name' => "Giv Biru",
                'price' => 11000,
                'currency' => 'IDR',
                'discount' => 0,
                'dimension' => '13 cm x 20 cm',
                'unit' => 'PCS',
                'created_at' => date('Y-m-d'),
            ),
        ];

        Product::insert($data);
    }
}
