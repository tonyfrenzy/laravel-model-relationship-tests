<?php

namespace Tests\Feature;

use App\Taggable;
use App\Country;
use App\Supplier;
use App\User;
use App\Post;
use App\Tag;
use App\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Schema;

class TaggablesTest extends TestCase
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

        $this->taggable = factory(Taggable::class)->create(); 
    } 

    /** @test */
    public function taggables_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('taggables', 
          [
            'id', 'tag_id', 'taggable_id', 'taggable_type'
          ]), 1);
    }

    /** @test  */
    public function a_taggable_morphs_to_many_videos()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->video->tags); 
    }

    /** @test  */
    public function a_taggable_morphs_to_many_posts()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->post->tags); 
    }
}
