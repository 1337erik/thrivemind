<?php

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

            UsersTableSeeder::class, // actually only ended up needing this one.. for now..
            // TasksTableSeeder::class,
            // RoutinesTableSeeder::class
        ]);
    }
}
