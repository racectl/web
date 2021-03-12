<?php

use App\Models\AccConfig;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_events', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AccConfig::class)->nullable();

            $table->string('track');
            $table->integer('pre_race_waiting_time_seconds')->default(60);
            $table->integer('session_over_time_seconds')->default(120);
            $table->tinyInteger('ambient_temp')->default(26);
            $table->tinyInteger('cloud_level')->default(35);
            $table->tinyInteger('rain')->default(15);
            $table->tinyInteger('weather_randomness')->default(3);
            $table->integer('config_version')->default(1);
            $table->integer('post_qualy_seconds')->default(120);
            $table->integer('post_race_seconds')->default(60);
            $table->string('meta_data')->nullable();
            $table->boolean('simracer_weather_conditions')->default(true);
            $table->boolean('is_fixed_condition_qualification')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acc_events');
    }
}
