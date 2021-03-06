<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeathersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weathers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('city_id');
            $table->dateTimeTz('local_datetime');
            $table->text('precip_type')->nullable();
            $table->decimal('precip_probability');
            $table->decimal('precip_intensity', 8, 4);
            $table->double('temperature');
            $table->double('apparent_temperature');
            $table->double('humidity');
            $table->double('pressure');
            $table->double('wind_speed');
            $table->double('wind_gust');
            $table->double('cloud_cover');
            $table->double('uv_index');
            $table->double('visibility', 8, 3);

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weathers');
    }
}
