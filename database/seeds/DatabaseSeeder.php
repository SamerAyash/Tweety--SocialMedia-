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
        factory(App\User::class,20)->create();
        \App\User::all()->each(function ($user){
            factory(App\Tweet::class,10)->create(['user_id'=>$user->id]);
        });
       //$this->call(TweetSeeder::class);
       $this->call(LikeSeeder::class);
    }
}
