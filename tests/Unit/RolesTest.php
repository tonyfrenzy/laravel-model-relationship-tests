<?php

namespace Tests\Unit;

use App\Role;
use App\Supplier;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class RolesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp() :void
    {
        parent::setUp();

        $this->supplier = factory(Supplier::class)->create();
        $this->user = factory(User::class)->create();
        $this->role = factory(Role::class)->create();
    } 

    /** @test  */
    public function roles_database_has_expected_columns()
    {
        $this->assertTrue( 
          Schema::hasColumns('roles', [
            'id', 'title', 'description'
        ]), 1);
    }

    /** @test  */
    public function a_role_belongs_to_many_users()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->role->users); 
    }
}
