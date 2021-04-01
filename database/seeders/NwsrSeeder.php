<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\User;
use Illuminate\Database\Seeder;

class NwsrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Dale',
            'last_name' => 'Carter',
            'discord_id' => '1',
            'steam_id' => '1',
            'email' => 'xthedalex@gmail.com'
        ]);

        $community = Community::create([
            'name' => 'New World Sim Racing',
            'slug' => 'new-world-sim-racing'
        ]);

        $community->members()->attach($user);
    }
}
