<?php

use App\Models\AccConfig;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccBopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_bops', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AccConfig::class);

            $table->integer('car_model');
            $table->integer('ballast_kg')->default(0);
            $table->integer('restrictor')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acc_bops');
    }
}
