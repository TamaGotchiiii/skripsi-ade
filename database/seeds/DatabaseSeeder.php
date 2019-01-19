<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\Unit::class, 5)->create();
        factory(App\User::class, 5)->create();
        factory(App\ComplainType::class, 5)->create();
        factory(App\Complain::class, 50)->create();
        factory(App\Attachment::class, 10)->create();
    }
}
