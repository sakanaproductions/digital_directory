<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BuildingTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_has_an_owner()
    {
        $user = factory(\App\User::class)->make();

        $building = factory(\App\Building::class)->make([
            'owner_id' => $user->id
        ]);

        $this->assertEquals($building->owner_id, $user->id);
        
    }

    /** @test */
    public function it_has_floors()
    {
        $building = factory(\App\Building::class)->make();

        $this->assertGreaterThan(0, $building->floors);
    }

    /** @test */
    public function it_can_add_tenants()
    {
        $building = factory(\App\Building::class)->make();

        $tenants = factory(\App\Tenant::class, 5)->make([
            'building_id' => $building->id
        ]);

        $building->addTenant($tenants);

        $this->assertCount(count($tenants), $building->tenants);
    }
}
