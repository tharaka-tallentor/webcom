<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_image', function (Blueprint $table) {
            $table->id('post_image_id');
            $table->unsignedBigInteger('post_fk_id')->nullable();
            $table->foreign('post_fk_id')->references('post_id')->on('post')->onDelete('cascade');
            $table->string('image_path')->nullable();
            $table->timestamp('insert_date');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_image');
    }
};
