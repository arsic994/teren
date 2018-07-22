<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('trip_id');
            $table->integer('hotel_id');
            $table->integer('bus_id');
            $table->string('bought')->nullable();
            $table->float('price')->nullable();
            $table->boolean('paid')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('purchases', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
