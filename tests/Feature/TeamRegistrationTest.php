<?php

namespace Tests\Feature;

use App\Actions\CreateAccEvent\CreateAccEventAction;
use App\Models\Community;
use App\Models\User;
use Tests\TestCase;

class TeamRegistrationTest extends TestCase
{

    /** @test */
    public function it_tests()
    {
        $this->assertTrue(true);
//        [$community, $event, $userOne, $userTwo, $userThree, $userFour] = $this->buildWorld();
//        $event->registerUser($userOne);
//        $event->registerUser($userTwo);
//        $event->registerUser($userThree);
//        $event->registerUser($userFour);
    }

    /**
     * This is used instead of setup because I hate using $this-> for every single variable.
     */
    protected function buildWorld()
    {
        $community = Community::first();
        $event = CreateAccEventAction::execute($community, 'Test Event');

        $userOne = User::factory()->create([
            'first_name' => 'Driver',
            'last_name' => 'One',
            'steam_id' => 11111111111111111
        ]);
        $userTwo = User::factory()->create([
            'first_name' => 'Driver',
            'last_name' => 'Two',
            'steam_id' => 22222222222222222
        ]);
        $userThree = User::factory()->create([
            'first_name' => 'Driver',
            'last_name' => 'Three',
            'steam_id' => 33333333333333333
        ]);
        $userFour = User::factory()->create([
            'first_name' => 'Driver',
            'last_name' => 'Four',
            'steam_id' => 44444444444444444
        ]);

        return [$community, $event, $userOne, $userTwo, $userThree, $userFour];
    }
}
