<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Questa riga farà in modo che il Seeder sia eseguito quando viene chiamato il comando php artisan db:seed.
        /* $this->call(UsersSeeder::class);

        $this->call(DishesSeeder::class);

        $this->call(CategoriesSeeder::class);
        
        $this->call(RestaurantsSeeder::class); */

        
        /* Comandi manuali da eseguire in ordine:
        1) php artisan migrate
        2) php artisan db:seed UsersTableSeeder
        3) php artisan db:seed CategoriesTableSeeder
        4) php artisan db:seed RestaurantsTableSeeder
        5) php artisan db:seed DishesTableSeeder
        6) php artisan db:seed OrdersTableSeeder
         */
    }
}
