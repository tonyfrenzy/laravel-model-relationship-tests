<?php

namespace Tests\Unit;

use App\Comment;
use App\Country;
use App\Post;
use App\Supplier;
use App\User;
use App\Video;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

class VideosTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp() :void
    {
        parent::setUp();

        $this->country = factory(Country::class)->create();
        $this->supplier = factory(Supplier::class)->create();
        $this->user = factory(User::class)->create();
        $this->post = factory(Post::class)->create(['user_id' => $this->user->id]);
        $this->video = factory(Video::class)->create(['user_id' => $this->user->id]);
        $this->comment = factory(Comment::class)->create([
          "commentable_id" => $this->video->id,
          "commentable_type" => "App\Video",
        ]);
    } 

    /** @test  */
    public function videos_database_has_expected_columns()
    {
        $this->assertTrue( 
          Schema::hasColumns('videos', [
            'id','user_id', 'title', 'description', 'size', 'length'
        ]), 1);
    }

    /** @test */
    public function a_video_belongs_to_a_user()
    {
        // Method 1: Test by count that a video has a parent relationship with user
        $this->assertEquals(1, $this->video->user->count());

        // Method 2: 
        $this->assertInstanceOf(User::class, $this->video->user);
    }

    /** @test  */
    public function a_video_morphs_many_comments()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->video->comments); 
    }

    /** @test  */
    public function a_video_can_be_associated_with_or_morph_to_many_tags()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->video->tags); 
    }
}
