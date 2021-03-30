<?php

use App\Models\Community;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccWeatherPresetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_weather_presets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Community::class);

            $table->string('name');
            $table->tinyInteger('ambient_temp');
            $table->tinyInteger('cloud_level');
            $table->tinyInteger('rain');
            $table->tinyInteger('weather_randomness');
            $table->boolean('simracer_weather_conditions');
            $table->boolean('is_fixed_condition_qualification');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acc_weather_presets');
    }
}
