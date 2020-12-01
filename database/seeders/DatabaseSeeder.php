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
         //\App\Models\User::factory(500)->create();
         //\App\Models\Tweet::factory(50)->create();
         //\App\Models\Like::factory(1000)->create();
         \App\Models\Comment::factory(1000)->create();
    }
}
