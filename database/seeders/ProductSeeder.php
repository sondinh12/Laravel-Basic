<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proSeed = [];
        $catgory_id = DB::table('categories')->pluck('id')->toArray();
        for($i=0;$i<5;$i++){
            $proSeed[] = [
                'name'=>fake()->name(),
                'price'=>fake()->randomNumber(),
                'quantity'=>fake()->randomNumber(),
                'image'=>fake()->image(),
                'category_id'=>fake()->randomElement($catgory_id),
                'description'=>fake()->text(),
                'status'=>fake()->numberBetween(0,1)
            ];
        }
        DB::table('products')->insert($proSeed);
    }
}
