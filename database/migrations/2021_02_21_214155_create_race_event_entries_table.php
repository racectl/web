<?php

use App\Models\RaceEvent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaceEventEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_event_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(RaceEvent::class);

            $table->string('team_name')->nullable();
            $table->string('team_join_code')->nullable();
            $table->integer('race_number')->default(-1);
            $table->integer('forced_car_model')->default(-1);
            $table->tinyInteger('default_grid_position')->default(-1);
            $table->tinyInteger('ballast_kg')->default(0);
            $table->tinyInteger('restrictor')->default(0);
            $table->boolean('override_driver_info')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('race_event_entries');
    }
}
