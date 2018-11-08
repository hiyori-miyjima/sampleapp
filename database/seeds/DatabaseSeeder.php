<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Achema\Blueprint;

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
        	AuthorsTableSeeder::class,
        	PublishersTableSeeder::class,
        	BookdetailsTableSeeder::class,
            UserSeeder::class
        	]);
    }
}
