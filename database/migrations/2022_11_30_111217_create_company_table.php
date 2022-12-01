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
        Schema::create('company', function (Blueprint $table) {
            $table->id('company_id');
            $table->string('name');
            $table->string('address');
            $table->bigInteger('tel')->nullable();
            $table->bigInteger('mobile');
            $table->string('email')->uniqid();
            $table->string('company_avatar');
            $table->string('web')->uniqid();
            $table->string('fb_page')->uniqid();
            $table->unsignedBigInteger('industry_fk_id');
            $table->foreign('industry_fk_id')->references('industry_id')->on('industry')->onDelete('cascade');
            $table->unsignedBigInteger('country_fk_id');
            $table->foreign('country_fk_id')->references('country_id')->on('country')->onDelete('cascade');
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
        Schema::dropIfExists('company');
    }
};
