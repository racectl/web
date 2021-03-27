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
        User::create([
            'first_name' => 'Dale',
            'last_name' => 'Carter',
            'discord_id' => '1',
            'steam_id' => '1',
            'email' => 'xthedalex@gmail.com'
        ]);

        Community::create([
            'name' => 'New World Sim Racing'
        ]);
    }
}