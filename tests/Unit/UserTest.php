<?php

namespace Tests\Unit;

use App\Comment;
use App\Phone;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test  */
    public function users_database_has_expected_columns()
    {
        $this->assertTrue( 
          Schema::hasColumns('users', [
            'id','name', 'email', 'email_verified_at', 'password'
        ]), 1);
    }

    /** @test */
    public function a_user_has_a_phone()
    {
        $user = factory(User::class)->create(); 
        $phone = factory(Phone::class)->create(['user_id' => $user->id]); 

        // Method 1:
        $this->assertInstanceOf(Phone::class, $user->phone); 

        // Method 2:
        $this->assertEquals(1, $user->phone->count());
    }

    /** @test */
    public function a_user_has_many_posts()
    {
        $user = factory(User::class)->create(); 
        $post = factory(Post::class)->create(['user_id' => $user->id]);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->posts);
    }

    /** @test */
    public function a_user_has_many_comments()
    {
        $user = factory(User::class)->create(); 
        $post = factory(Post::class)->create(['user_id' => $user->id]);
        $comment = factory(Comment::class)->create(['post_id' => $post->id]);
        
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->comments);
    }
}
