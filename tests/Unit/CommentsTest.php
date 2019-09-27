<?php

namespace Tests\Unit;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test  */
    public function comments_database_has_expected_columns()
    {
        $this->assertTrue( 
          Schema::hasColumns('comments', [
            'id','user_id', 'post_id', 'body'
        ]), 1);
    }

    /** @test */
    public function a_comment_belongs_to_a_post()
    {
        $user = factory(User::class)->create(); 
        $post = factory(Post::class)->create(['user_id' => $user->id]);
        $comment = factory(Comment::class)->make(['post_id' => $post->id]);
        
        // Method 1: Test by count that a comment has a parent relationship with post
        $this->assertEquals(1, $comment->post->count());

        // Method 2: 
        $this->assertInstanceOf(Post::class, $comment->post);
    }

    /** @test */
    public function a_comment_belongs_to_a_user()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create(['user_id' => $user->id]);
        $comment = factory(Comment::class)->make(['user_id' => $user->id]); 

        $this->assertInstanceOf(User::class, $comment->user);
    }
}
