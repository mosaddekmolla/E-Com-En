<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
                [
                    'name'=>'Nokia',
                    'price'=>'17000',
                    'category'=>'mobile',
                    'description'=>'Nokia 2',
                    'gallery'=>'https://www.gsmarena.com.bd/images/products/nokia-2.jpg',
                ],
                
            
            ]);

    }

}