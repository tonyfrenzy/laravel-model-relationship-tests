<?php

namespace Tests\Unit;

use App\Country;
use App\Image;
use App\Post;
use App\Supplier;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ImagesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp() :void
    {
        parent::setUp();

        $this->country = factory(Country::class)->create();
        $this->supplier = factory(Supplier::class)->create();
        $this->user = factory(User::class)->create();
        $this->post = factory(Post::class)->create();
        $this->image = factory(Image::class)->create(); 
    } 

    /** @test */
    public function images_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('images', 
          [
            'id', "url", "imageable_id", "imageable_type"
          ]), 1);
    }

    /** @test */
    public function an_image_can_be_uploaded_by_a_user() // morphedTo a USER
    {
        $image = factory(Image::class)->create([
          "imageable_id" => $this->user->id,
          "imageable_type" => "App\User",
        ]); 

        $this->assertInstanceOf(User::class, $image->imageable);
    }

    /** @test */
    public function an_image_can_be_uploaded_for_a_post() // morphedTo a POST
    {
        $image = factory(Image::class)->create([
          "imageable_id" => $this->post->id,
          "imageable_type" => "App\Post",
        ]); 

        $this->assertInstanceOf(Post::class, $image->imageable);
    }
}
