<?php


namespace Tests\Feature\Models;


use App\Models\Car;
use Database\Seeders\CarSeeder;
use Tests\TestCase;

class CarModelTest extends TestCase
{
    /** @test */
    public function it_seeds()
    {
        //fix to reset ids when running full test suit.
        Car::truncate();

        $this->seed(CarSeeder::class);
        $cars = Car::all();

        $this->assertCount(37, $cars);

        $expected = [
            'id'   => 0,
            'name' => 'Porsche 991 GT3 R',
            'sim'  => 'acc',
            'type' => 'GT3'
        ];

        $this->assertEquals($expected, $cars->first()->toArray());
    }

    /** @test */
    public function it_has_an_acc_gt3_scope()
    {
        $expected = Car::where(['type' => 'GT3', 'sim' => 'acc'])->get();
        $actual = Car::accGt3s()->get();

        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function it_has_an_acc_gt4_scope()
    {
        $expected = Car::where(['type' => 'GT4', 'sim' => 'acc'])->get();
        $actual = Car::accGt4s()->get();

        $this->assertEquals($expected, $actual);
    }
}
