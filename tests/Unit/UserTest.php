<?php

namespace Tests\Unit;

use App\Comment;
use App\Country;
use App\Image;
use App\Phone;
use App\Post;
use App\Role;
use App\Supplier;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp() :void
    {
        parent::setUp();

        $this->country = factory(Country::class)->create();
        $this->supplier = factory(Supplier::class)->create();
        $this->user = factory(User::class)->create();
        $this->phone = factory(Phone::class)->create(['user_id' => $this->user->id]); 
        $this->post = factory(Post::class)->create(['user_id' => $this->user->id]);
        $this->comment = factory(Comment::class)->create(['post_id' => $this->post->id]);
        $this->role = factory(Role::class)->create();
        $this->image = factory(Image::class)->create([
          "imageable_id" => $this->user->id,
          "imageable_type" => "App\User",
        ]);
    } 

    /** @test  */
    public function users_database_has_expected_columns()
    {
        $this->assertTrue( 
          Schema::hasColumns('users', [
            'id','name', 'email', 'email_verified_at', 'password', 'supplier_id', 'country_id'
        ]), 1);
    }

    /** @test */
    public function a_user_has_a_phone()
    {
        // Method 1:
        $this->assertInstanceOf(Phone::class, $this->user->phone); 

        // Method 2:
        $this->assertEquals(1, $this->user->phone->count());
    }

    /** @test */
    public function a_user_has_many_posts()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->user->posts);
    }

    /** @test */
    public function a_user_has_many_comments()
    {        
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->user->comments);
    }

    /** @test  */
    public function a_user_belongs_to_many_roles()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->user->roles); 
    }

    /** @test  */
    public function a_user_belongs_to_a_country()
    {
        $this->assertInstanceOf(Country::class, $this->user->country); 
    }

    /** @test  */
    public function a_user_morphs_one_image()
    {
        $this->assertInstanceOf(Image::class, $this->user->image); 
    }
}
