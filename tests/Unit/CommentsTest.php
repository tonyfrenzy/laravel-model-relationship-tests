<?php

namespace Tests\Unit;

use App\Comment;
use App\Country;
use App\Post;
use App\Supplier;
use App\User;
use App\Video;
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

        $this->country = factory(Country::class)->create();
        $this->supplier = factory(Supplier::class)->create();
        $this->user = factory(User::class)->create();
        $this->post = factory(Post::class)->create();
        $this->video = factory(Video::class)->create();
        $this->comment = factory(Comment::class)->create();
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

    /** @test */
    public function a_comment_can_be_morphed_to_a_video_model()
    {
        $comment = factory(Comment::class)->create([
          "commentable_id" => $this->video->id,
          "commentable_type" => "App\Video",
        ]); 

        $this->assertInstanceOf(Video::class, $comment->commentable);
    }

    /** @test */
    public function a_comment_can_be_morphed_to_a_post_model()
    {
        $comment = factory(Comment::class)->create([
          "commentable_id" => $this->post->id,
          "commentable_type" => "App\Post",
        ]); 

        $this->assertInstanceOf(Post::class, $comment->commentable);
    }
}
