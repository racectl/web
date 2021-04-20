<?php

use App\Models\Community;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccPitConditionsPresetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_pit_conditions_presets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Community::class)->default(0);
            $table->string('name');

            $table->integer('pit_window_length_sec');
            $table->integer('driver_stint_time_sec');
            $table->unsignedTinyInteger('mandatory_pitstop_count');
            $table->integer('max_total_driving_time');
            $table->boolean('is_refuelling_allowed_in_race');
            $table->boolean('is_refuelling_time_fixed');
            $table->boolean('is_mandatory_pitstop_refuelling_required');
            $table->boolean('is_mandatory_pitstop_tyre_change_required');
            $table->boolean('is_mandatory_pitstop_swap_driver_required');
            $table->unsignedTinyInteger('tyre_set_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acc_pit_conditions_presets');
    }
}
