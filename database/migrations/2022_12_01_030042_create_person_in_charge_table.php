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
        Schema::create('person_in_charge', function (Blueprint $table) {
            $table->id('pic_id');
            $table->uuid('pic_uuid');
            $table->string('name');
            $table->string('email')->uniqid();
            $table->string('password');
            $table->bigInteger('mobile');
            $table->string('authorize_by')->nullable();
            $table->string('type')->nullable();
            $table->string('position')->nullable();
            $table->boolean('status');
            $table->unsignedBigInteger('company_fk_id');
            $table->foreign('company_fk_id')->references('company_id')->on('company')->onDelete('cascade');
            $table->timestamp('registor_date');
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
        Schema::dropIfExists('person_in_charge');
    }
};
