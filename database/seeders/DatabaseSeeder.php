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
        //\App\Models\Comment::factory(1000)->create();
        //\App\Models\Hashtag::factory(5000)->create();

        $hashtags =array (0=>"#science",1=> "#earthquake",2=> "#yes", 3=> "#Hakim", 4 => "#islam");
        $cpt = 1;
        for ($i=1; $i <=  109; $i++) { 
            \DB::table('hashtags')->insert([
                'id' =>  $cpt,
                'hashtag' => $hashtags[rand(0, 4)],
                'tweet_id' =>  $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $cpt ++;
        }
        
    }
}
