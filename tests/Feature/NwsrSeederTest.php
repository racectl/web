<?php

namespace Tests\Feature;

use Tests\TestCase;

class NwsrSeederTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertDatabaseHas('users', [
            'first_name' => 'Dale',
            'last_name' => 'Carter'
        ]);

        $this->assertDatabaseHas('communities', [
            'name' => 'New World Sim Racing'
        ]);
    }
}
