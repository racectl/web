<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class NwsrSeederTest extends TestCase
{
    /**
     * Fails on full suite.
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
