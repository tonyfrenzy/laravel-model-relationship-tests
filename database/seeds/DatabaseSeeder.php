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
        // $this->call(UsersTableSeeder::class);

        factory(App\User::class, 3)->create();
        factory(App\Phone::class, 3)->create();
        factory(App\Post::class, 3)->create();
        factory(App\Comment::class, 15)->create();
    }
}
