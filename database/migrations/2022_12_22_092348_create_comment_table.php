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
        Schema::create('comment', function (Blueprint $table) {
            $table->id('comment_id');
            $table->binary('comment');
            $table->unsignedBigInteger('post_fk_id');
            $table->foreign('post_fk_id')->references('post_id')->on('post')->onDelete('cascade');
            $table->unsignedBigInteger('pic_fk_id');
            $table->foreign('pic_fk_id')->references('pic_id')->on('person_in_charge')->onDelete('cascade');
            $table->timestamp('comment_date');
            $table->timestamps();
            $table->engine = "InnoDB";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment');
    }
};
