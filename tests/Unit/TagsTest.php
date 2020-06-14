<?php

namespace Tests\Unit;

use App\Country;
use App\Supplier;
use App\User;
use App\Post;
use App\Tag;
use App\Video;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

class TagsTest extends TestCase
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
        $this->tag = factory(Tag::class)->create();
    } 

    /** @test */
    public function tags_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('tags', 
          [
            'id', 'name', 'description'
          ]), 1);
    }


    /** @test  */
    public function a_tag_can_be_assigned_to_or_morphed_by_many_videos()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->tag->videos); 
    }

    /** @test  */
    public function a_tag_can_be_assigned_to_or_morphed_by_many_posts()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->tag->posts); 
    }
}
