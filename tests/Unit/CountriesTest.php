<?php

namespace Tests\Unit;

use App\Country;
use App\Post;
use App\Supplier;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CountriesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp() :void
    {
        parent::setUp();

        $this->country = factory(Country::class)->create();
        $this->supplier = factory(Supplier::class)->create();
        $this->user = factory(User::class)->create();
        $this->post = factory(Post::class)->create(['user_id' => $this->user->id]); 
    } 

    /** @test  */
    public function countries_database_has_expected_columns()
    {
        $this->assertTrue( 
          Schema::hasColumns('countries', [
            'id', 'name', 'population'
        ]), 1);
    }

    /** @test */
    public function a_country_has_many_posts_through_user()
    {
        // Method 1:
        $this->assertTrue($this->country->posts->contains($this->post));
        
        // Method 2:
        $this->assertEquals(1, $this->country->posts->count());

        // Method 3:
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->country->posts);
    }
}
