<?php

namespace Tests\Unit;

use App\Comment;
use App\Country;
use App\Image;
use App\Post;
use App\Supplier;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp() :void
    {
        parent::setUp();

        $this->country = factory(Country::class)->create();
        $this->supplier = factory(Supplier::class)->create();
        $this->user = factory(User::class)->create();
        $this->post = factory(Post::class)->create(['user_id' => $this->user->id]);
        // $this->comment = factory(Comment::class)->create(['post_id' => $this->post->id]);
        $this->image = factory(Image::class)->create([
          "imageable_id" => $this->post->id,
          "imageable_type" => "App\Post",
        ]);
        $this->comment = factory(Comment::class)->create([
          "commentable_id" => $this->post->id,
          "commentable_type" => "App\Post",
        ]);
    } 

    /** @test  */
    public function posts_database_has_expected_columns()
    {
        $this->assertTrue( 
          Schema::hasColumns('posts', [
            'id','user_id', 'title', 'body'
        ]), 1);
    }

    /** @test */
    public function a_post_has_many_comments()
    {   
        // Method 1: A comment exists in a post's comment collections.
        $this->assertTrue($this->post->comments->contains($this->comment));
        
        // Method 2: Count that a post comments collection exists.
        $this->assertEquals(1, $this->post->comments->count());

        // Method 3: Comments are related to posts and is a collection instance.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->post->comments);
    }

    /** @test */
    public function a_post_belongs_to_a_user()
    {
        $this->assertInstanceOf(User::class, $this->post->user);
    }

    /** @test  */
    public function a_post_morphs_one_image()
    {
        $this->assertInstanceOf(Image::class, $this->post->image); 
    }

    /** @test  */
    public function a_post_morphs_many_comments()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->post->comments); 
    }

    /** @test  */
    public function a_post_morphs_many_tags()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->post->tags); 
    }
}
