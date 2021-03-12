<?php

namespace Database\Seeders;

use App\Models\Track;
use Illuminate\Database\Seeder;

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Track::insert(
            $this->getData()
        );
    }

    protected function getData(): array
    {
        return [
            [
                'game_config_id'   => 'monza',
                'name'             => 'Monza 2018',
                'sim'              => 'acc',
                'pit_boxes'        => 29,
                'max_server_slots' => 60
            ],[
                'game_config_id'   => 'zolder',
                'name'             => 'Zolder 2018',
                'sim'              => 'acc',
                'pit_boxes'        => 34,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'brands_hatch',
                'name'             => 'Brands Hatch 2018',
                'sim'              => 'acc',
                'pit_boxes'        => 32,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'silverstone',
                'name'             => 'Silverstone 2018',
                'sim'              => 'acc',
                'pit_boxes'        => 36,
                'max_server_slots' => 60
            ],[
                'game_config_id'   => 'paul_ricard',
                'name'             => 'Paul Ricard 2018',
                'sim'              => 'acc',
                'pit_boxes'        => 33,
                'max_server_slots' => 80
            ],[
                'game_config_id'   => 'misano',
                'name'             => 'Misano 2018',
                'sim'              => 'acc',
                'pit_boxes'        => 30,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'spa',
                'name'             => 'Spa 2018',
                'sim'              => 'acc',
                'pit_boxes'        => 82,
                'max_server_slots' => 82
            ],[
                'game_config_id'   => 'nurburgring',
                'name'             => 'Nurburgring 2018',
                'sim'              => 'acc',
                'pit_boxes'        => 30,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'barcelona',
                'name'             => 'Barcelona 2018',
                'sim'              => 'acc',
                'pit_boxes'        => 29,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'hungaroring',
                'name'             => 'Hungaroring 2018',
                'sim'              => 'acc',
                'pit_boxes'        => 27,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'zandvoort',
                'name'             => 'Zandvoort 2018',
                'sim'              => 'acc',
                'pit_boxes'        => 25,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'monza_2019',
                'name'             => 'Monza 2019',
                'sim'              => 'acc',
                'pit_boxes'        => 29,
                'max_server_slots' => 60
            ],[
                'game_config_id'   => 'zolder_2019',
                'name'             => 'Zolder 2019',
                'sim'              => 'acc',
                'pit_boxes'        => 34,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'brands_hatch_2019',
                'name'             => 'Brands Hatch 2019',
                'sim'              => 'acc',
                'pit_boxes'        => 32,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'silverstone_2019',
                'name'             => 'Silverstone 2019',
                'sim'              => 'acc',
                'pit_boxes'        => 36,
                'max_server_slots' => 60
            ],[
                'game_config_id'   => 'paul_ricard_2019',
                'name'             => 'Paul Ricard 2019',
                'sim'              => 'acc',
                'pit_boxes'        => 33,
                'max_server_slots' => 80
            ],[
                'game_config_id'   => 'misano_2019',
                'name'             => 'Misano 2019',
                'sim'              => 'acc',
                'pit_boxes'        => 30,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'spa_2019',
                'name'             => 'Spa 2019',
                'sim'              => 'acc',
                'pit_boxes'        => 82,
                'max_server_slots' => 82
            ],[
                'game_config_id'   => 'nurburgring_2019',
                'name'             => 'Nurburgring 2019',
                'sim'              => 'acc',
                'pit_boxes'        => 30,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'barcelona_2019',
                'name'             => 'Barcelona 2019',
                'sim'              => 'acc',
                'pit_boxes'        => 29,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'hungaroring_2019',
                'name'             => 'Hungaroring 2019',
                'sim'              => 'acc',
                'pit_boxes'        => 27,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'zandvoort_2019',
                'name'             => 'Zandvoort 2019',
                'sim'              => 'acc',
                'pit_boxes'        => 25,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'kyalami_2019',
                'name'             => 'Kyalami 2019',
                'sim'              => 'acc',
                'pit_boxes'        => 40,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'mount_panorama_2019',
                'name'             => 'Mount Panorama 2019',
                'sim'              => 'acc',
                'pit_boxes'        => 36,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'suzuka_2019',
                'name'             => 'Suzuka 2019',
                'sim'              => 'acc',
                'pit_boxes'        => 51,
                'max_server_slots' => 105
            ],[
                'game_config_id'   => 'laguna_seca_2019',
                'name'             => 'Laguna Seca 2019',
                'sim'              => 'acc',
                'pit_boxes'        => 30,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'monza_2020',
                'name'             => 'Monza 2020',
                'sim'              => 'acc',
                'pit_boxes'        => 29,
                'max_server_slots' => 60
            ],[
                'game_config_id'   => 'zolder_2020',
                'name'             => 'Zolder 2020',
                'sim'              => 'acc',
                'pit_boxes'        => 34,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'brands_hatch_2020',
                'name'             => 'Brands Hatch 2020',
                'sim'              => 'acc',
                'pit_boxes'        => 32,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'silverstone_2020',
                'name'             => 'Silverstone 2020',
                'sim'              => 'acc',
                'pit_boxes'        => 36,
                'max_server_slots' => 60
            ],[
                'game_config_id'   => 'paul_ricard_2020',
                'name'             => 'Paul Ricard 2020',
                'sim'              => 'acc',
                'pit_boxes'        => 33,
                'max_server_slots' => 80
            ],[
                'game_config_id'   => 'misano_2020',
                'name'             => 'Misano 2020',
                'sim'              => 'acc',
                'pit_boxes'        => 30,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'spa_2020',
                'name'             => 'Spa 2020',
                'sim'              => 'acc',
                'pit_boxes'        => 82,
                'max_server_slots' => 82
            ],[
                'game_config_id'   => 'nurburgring_2020',
                'name'             => 'Nurburgring 2020',
                'sim'              => 'acc',
                'pit_boxes'        => 30,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'barcelona_2020',
                'name'             => 'Barcelona 2020',
                'sim'              => 'acc',
                'pit_boxes'        => 29,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'hungaroring_2020',
                'name'             => 'Hungaroring 2020',
                'sim'              => 'acc',
                'pit_boxes'        => 27,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'zandvoort_2020',
                'name'             => 'Zandvoort 2020',
                'sim'              => 'acc',
                'pit_boxes'        => 25,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'imola_2020',
                'name'             => 'Imola 2020',
                'sim'              => 'acc',
                'pit_boxes'        => 30,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'oulton_park_2019',
                'name'             => 'Oulton Park 2019',
                'sim'              => 'acc',
                'pit_boxes'        => 28,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'donington_2019',
                'name'             => 'Donington 2019',
                'sim'              => 'acc',
                'pit_boxes'        => 37,
                'max_server_slots' => 50
            ],[
                'game_config_id'   => 'snetterton_2019',
                'name'             => 'Snetterton 2019',
                'sim'              => 'acc',
                'pit_boxes'        => 26,
                'max_server_slots' => 50
            ]
        ];
    }
}
