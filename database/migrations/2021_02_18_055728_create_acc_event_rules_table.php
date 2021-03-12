<?php

use App\Models\AccConfig;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccEventRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_event_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AccConfig::class)->nullable();

            $table->tinyInteger('qualify_standing_type')->default(1);
            $table->integer('pit_window_length_sec')->default(-1);
            $table->integer('driver_stint_time_sec')->default(-1);
            $table->unsignedTinyInteger('mandatory_pitstop_count')->default(0);
            $table->integer('max_total_driving_time')->default(-1);
            $table->unsignedTinyInteger('max_drivers_count')->default(1);
            $table->boolean('is_refuelling_allowed_in_race')->default(true);
            $table->boolean('is_refuelling_time_fixed')->default(false);
            $table->boolean('is_mandatory_pitstop_refuelling_required')->default(false);
            $table->boolean('is_mandatory_pitstop_tyre_change_required')->default(false);
            $table->boolean('is_mandatory_pitstop_swap_driver_required')->default(false);
            $table->unsignedTinyInteger('tyre_set_count')->default(50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acc_event_rules');
    }
}
