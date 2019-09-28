<?php

namespace Tests\Unit;

use App\Comment;
use App\Post;
use App\Supplier;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp() :void
    {
        parent::setUp();

        $this->supplier = factory(Supplier::class)->create();
        $this->user = factory(User::class)->create();
        $this->post = factory(Post::class)->create(['user_id' => $this->user->id]);
        $this->comment = factory(Comment::class)->create(['post_id' => $this->post->id]);
    } 

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
        // Method 1: Test by count that a comment has a parent relationship with post
        $this->assertEquals(1, $this->comment->post->count());

        // Method 2: 
        $this->assertInstanceOf(Post::class, $this->comment->post);
    }

    /** @test */
    public function a_comment_belongs_to_a_user()
    {
        $this->assertInstanceOf(User::class, $this->comment->user);
    }
}
