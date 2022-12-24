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
        Schema::create('connection_list', function (Blueprint $table) {
            $table->id('connection_list_id');
            $table->unsignedBigInteger('connection_fk_id');
            $table->foreign('connection_fk_id')->references('connection_id')->on('connection')->onDelete('cascade');
            $table->unsignedBigInteger('company_fk_id');
            $table->foreign('company_fk_id')->references('company_id')->on('company')->onDelete('cascade');
            $table->boolean('approve_status');
            $table->timestamp('listed_date');
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
        Schema::dropIfExists('connection_list');
    }
};
