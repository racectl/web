<?php

use App\Models\AccConfig;
use App\Models\Community;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccAssistRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_assist_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AccConfig::class)->nullable()->nullable();

            $table->foreignIdFor(Community::class, 'preset_for_community')->nullable();
            $table->string('preset_name')->nullable();

            $table->tinyInteger('stability_control_level_max')->default(25);
            $table->boolean('disable_autosteer')->default(0);
            $table->boolean('disable_auto_lights')->default(0);
            $table->boolean('disable_auto_wiper')->default(0);
            $table->boolean('disable_auto_engine_start')->default(0);
            $table->boolean('disable_auto_pit_limiter')->default(0);
            $table->boolean('disable_auto_gear')->default(0);
            $table->boolean('disable_auto_clutch')->default(0);
            $table->boolean('disable_ideal_line')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acc_assist_rules');
    }
}
