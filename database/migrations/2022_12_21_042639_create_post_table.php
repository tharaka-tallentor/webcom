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
        Schema::create('post', function (Blueprint $table) {
            $table->id('post_id');
            $table->string('title');
            $table->longText('content');
            $table->unsignedBigInteger('pic_fk_id');
            $table->foreign('pic_fk_id')->references('pic_id')->on('person_in_charge')->onDelete('cascade');
            $table->unsignedBigInteger('company_fk_id');
            $table->foreign('company_fk_id')->references('company_id')->on('company')->onDelete('cascade');
            $table->timestamp('post_date');
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
        Schema::dropIfExists('post');
    }
};
