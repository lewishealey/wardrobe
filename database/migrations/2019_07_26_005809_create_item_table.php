<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name')->nullable();
            $table->string('status'); // Have, want
            $table->string('type'); // Tops, bottoms, accessories
            $table->string('category'); // Hoodie, Jumper

            $table->string('colour')->nullable(); // Black, white
            $table->string('link')->nullable();
            $table->string('fabric')->nullable();
            $table->string('quality')->nullable();
            $table->string('price')->nullable();
            $table->string('brand')->nullable();
            $table->string('year')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item');
    }
}
