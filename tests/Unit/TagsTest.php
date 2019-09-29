<?php

namespace Tests\Unit;

use App\Tag;
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

        $this->tag = factory(Tag::class)->create(); 
    } 

    /** @test */
    public function phones_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('tags', 
          [
            'id', 'name', 'description'
          ]), 1);
    }
}
