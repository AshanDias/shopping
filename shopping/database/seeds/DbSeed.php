<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DbSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert(
            [
                'id' => 1,
                'name' => 'Mango'
            ]);

            DB::table('products')->insert([
                'id' => 2,
                'name' => 'Vegetables'
            ]);

            DB::table('products')->insert(  [
                'id' => 3,
                'name' => 'Fruits'
            ]);
            DB::table('products')->insert([
                'id' => 4,
                'name' => 'Juice'
            ]);
            DB::table('products')->insert( [
                'id' => 5,
                'name' => 'Meats'
            ]);
      
    }
}
