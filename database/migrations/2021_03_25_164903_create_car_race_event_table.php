<?php

use App\Models\Car;
use App\Models\RaceEvent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarRaceEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_race_event', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(RaceEvent::class);
            $table->foreignIdFor(Car::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_race_event');
    }
}
