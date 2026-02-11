<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
   public function run()
{
    $this->call([
        SeasonSeeder::class,  // 先に季節を入れる
        ProductSeeder::class, // その後に商品を入れる
    ]);
}
}
