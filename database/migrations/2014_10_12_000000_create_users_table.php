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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->uuid('user_uuid')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('authorize_by')->nullable();
            $table->string('designation')->nullable();
            $table->bigInteger('mobile')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('user_avatar');
            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();
            $table->timestamp('registor_date')->nullable();
            $table->unsignedBigInteger('role_fk_id')->nullable();
            $table->foreign('role_fk_id')->references('role_id')->on('role')->onDelete('cascade');
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
        Schema::dropIfExists('users');
    }
};
