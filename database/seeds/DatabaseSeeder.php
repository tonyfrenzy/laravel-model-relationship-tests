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

        factory(App\Supplier::class, 5)->create();
        factory(App\User::class, 3)->create();
        factory(App\Phone::class, 3)->create();
        factory(App\Post::class, 3)->create();
        factory(App\Comment::class, 15)->create();
        factory(App\Role::class, 5)->create();
        factory(App\History::class, 5)->create();
    }
}
