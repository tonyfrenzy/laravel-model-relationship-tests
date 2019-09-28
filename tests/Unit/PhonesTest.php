<?php

namespace Tests\Unit;

use App\Phone;
use App\Supplier;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PhonesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp() :void
    {
        parent::setUp();

        $this->supplier = factory(Supplier::class)->create();
        $this->user = factory(User::class)->create();
        $this->phone = factory(Phone::class)->create(['user_id' => $this->user->id]); 
    } 

    /** @test */
    public function phones_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('phones', 
          [
            'id', 'user_id', 'number'
          ]), 1);
    }

    /** @test */
    public function a_phone_belongs_to_a_user()
    {
        $this->assertInstanceOf(User::class, $this->phone->user);
    }
}
