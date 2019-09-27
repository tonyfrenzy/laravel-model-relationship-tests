<?php

namespace Tests\Unit;

use App\Phone;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PhonesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

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
        $user = factory(User::class)->create();
        $phone = factory(Phone::class)->create(['user_id' => $user->id]); 

        $this->assertInstanceOf(User::class, $phone->user);
    }
}
