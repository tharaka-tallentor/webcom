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
        Schema::create('approve', function (Blueprint $table) {
            $table->id('approve_id');
            $table->unsignedBigInteger('company_fk_id');
            $table->foreign('company_fk_id')->references('company_id')->on('company')->onDelete('cascade');
            $table->timestamp('approuve_date');
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
        Schema::dropIfExists('approve');
    }
};
