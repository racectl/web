<?php

use App\Models\AccConfig;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AccConfig::class)->nullable();

            $table->string('server_name');
            $table->string('admin_password')->nullable();
            $table->string('car_group')->default('FreeForAll');
            $table->tinyInteger('track_medals_requirement')->default(0);
            $table->tinyInteger('safety_rating_requirement')->default(-1);
            $table->tinyInteger('racecraft_rating_requirement')->default(-1);
            $table->string('password')->nullable();
            $table->string('spectator_password')->nullable();
            $table->tinyInteger('max_car_slots')->nullable();
            $table->boolean('dump_leaderboards')->default(1);
            $table->boolean('is_race_locked')->default(1);
            $table->boolean('randomize_track_when_empty')->default(0);
            $table->string('central_entry_list_path')->nullable();
            $table->boolean('allow_auto_d_q')->default(0);
            $table->boolean('short_formation_lap')->default(0);
            $table->boolean('dump_entry_list')->default(0);
            $table->tinyInteger('formation_lap_type')->default(3);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acc_settings');
    }
}
