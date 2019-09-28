<?php

namespace Tests\Unit;

use App\Country;
use App\History;
use App\Supplier;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SuppliersTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp() :void
    {
        parent::setUp();

        $this->country = factory(Country::class)->create();
        $this->supplier = factory(Supplier::class)->create();
        $this->user = factory(User::class)->create();
        $this->history = factory(History::class)->create(['user_id' => $this->user->id]); 
    } 

    /** @test  */
    public function suppliers_database_has_expected_columns()
    {
        $this->assertTrue( 
          Schema::hasColumns('suppliers', [
            'id', 'name', 'services'
        ]), 1);
    }

    /** @test */
    public function a_supplier_has_an_history_through_user()
    {
        // Method 1:
        $this->assertInstanceOf(History::class, $this->supplier->userHistory); 

        // Method 2:
        $this->assertEquals(1, $this->supplier->userHistory->count());
    }
}
