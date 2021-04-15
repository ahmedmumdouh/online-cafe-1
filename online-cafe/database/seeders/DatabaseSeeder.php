<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Room;
use App\Models\Category;

use Database\Seeders\CategoryTableSeeder;
use Database\Seeders\ProductTableSeeder;
use Database\Seeders\RoomTableSeeder;
use Database\Seeders\OrderTableSeeder;
use Database\Seeders\UserTableSeeder;
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
        // User::factory(10)->hasOrders(2)->create();
        // Order::factory(10)->hasProducts(2)->create();

        $this->call([
            UserTableSeeder::class,
            ProductTableSeeder::class,
            CategoryTableSeeder::class,
            RoomTableSeeder::class,
            OrderTableSeeder::class,
        ]);
    }
}
