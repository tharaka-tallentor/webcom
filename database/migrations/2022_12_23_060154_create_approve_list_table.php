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
        Schema::create('approve_list', function (Blueprint $table) {
            $table->id('approve_list_id');
            $table->unsignedBigInteger('approve_fk_id');
            $table->foreign('approve_fk_id')->references('approve_id')->on('approve')->onDelete('cascade');
            $table->unsignedBigInteger('connection_fk_id');
            $table->foreign('connection_fk_id')->references('connection_id')->on('connection')->onDelete('cascade');
            $table->timestamp('approve_list_date');
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
        Schema::dropIfExists('approve_list');
    }
};
