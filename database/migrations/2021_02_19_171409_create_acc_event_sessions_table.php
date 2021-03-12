<?php

use App\Models\Configs\ACC\AccEvent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccEventSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_event_sessions', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(AccEvent::class);
            $table->tinyInteger('hour_of_day');
            $table->tinyInteger('day_of_weekend');
            $table->tinyInteger('time_multiplier')->default(0);
            $table->char('session_type', 1);
            $table->integer('session_duration_minutes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acc_event_sessions');
    }
}
