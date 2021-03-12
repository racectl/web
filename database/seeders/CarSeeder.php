<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Car::insert(
            $this->getData()
        );
    }

    public function getData(): array
    {
        return [
            [
                'id'   => 0,
                'name' => 'Porsche 991 GT3 R',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 1,
                'name' => 'Mercedes-AMG GT3',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 2,
                'name' => 'Ferrari 488 GT3',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 3,
                'name' => 'Audi R8 LMS',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 4,
                'name' => 'Lamborghini Huracan GT3',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 5,
                'name' => 'McLaren 650S GT3',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 6,
                'name' => 'Nissan GT-R Nismo GT3 2018',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 7,
                'name' => 'BMW M6 GT3',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 8,
                'name' => 'Bentley Continental GT3 2018',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 9,
                'name' => 'Porsche 991II GT3 Cup',
                'sim'  => 'acc',
                'type' => 'Cup'
            ],[
                'id'   => 10,
                'name' => 'Nissan GT-R Nismo GT3 2017',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 11,
                'name' => 'Bentley Continental GT3 2016',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 12,
                'name' => 'Aston Martin V12 Vantage GT3',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 13,
                'name' => 'Lamborghini Gallardo R-EX',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 14,
                'name' => 'Jaguar G3',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 15,
                'name' => 'Lexus RC F GT3',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 16,
                'name' => 'Lamborghini Huracan Evo (2019)',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 17,
                'name' => 'Honda NSX GT3',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 18,
                'name' => 'Lamborghini Huracan SuperTrofeo',
                'sim'  => 'acc',
                'type' => 'ST'
            ],[
                'id'   => 19,
                'name' => 'Audi R8 LMS Evo',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 20,
                'name' => 'AMR V8 Vantage',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 21,
                'name' => 'Honda NSX Evo',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 22,
                'name' => 'McLaren 720S GT3',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 23,
                'name' => 'Porsche 911II GT3 R',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 24,
                'name' => 'Ferrari 488 GT3 Evo 2020',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 25,
                'name' => 'Mercedes-AMG GT3 2020',
                'sim'  => 'acc',
                'type' => 'GT3'
            ],[
                'id'   => 50,
                'name' => 'Alpine A110 GT4',
                'sim'  => 'acc',
                'type' => 'GT4'
            ],[
                'id'   => 51,
                'name' => 'AMR V8 Vantage GT4',
                'sim'  => 'acc',
                'type' => 'GT4'
            ],[
                'id'   => 52,
                'name' => 'Audi R8 LMS GT4',
                'sim'  => 'acc',
                'type' => 'GT4'
            ],[
                'id'   => 53,
                'name' => 'BMW M4 GT4',
                'sim'  => 'acc',
                'type' => 'GT4'
            ],[
                'id'   => 55,
                'name' => 'Chevrolet Camaro GT4',
                'sim'  => 'acc',
                'type' => 'GT4'
            ],[
                'id'   => 56,
                'name' => 'Ginetta G55 GT4',
                'sim'  => 'acc',
                'type' => 'GT4'
            ],[
                'id'   => 57,
                'name' => 'KTM X-Bow GT4',
                'sim'  => 'acc',
                'type' => 'GT4'
            ],[
                'id'   => 58,
                'name' => 'Maserati MC GT4',
                'sim'  => 'acc',
                'type' => 'GT4'
            ],[
                'id'   => 59,
                'name' => 'McLaren 570S GT4',
                'sim'  => 'acc',
                'type' => 'GT4'
            ],[
                'id'   => 60,
                'name' => 'Mercedes-AMG GT4',
                'sim'  => 'acc',
                'type' => 'GT4'
            ],[
                'id'   => 61,
                'name' => 'Porsche 718 Cayman GT4',
                'sim'  => 'acc',
                'type' => 'GT4'
            ],
        ];
    }
}
