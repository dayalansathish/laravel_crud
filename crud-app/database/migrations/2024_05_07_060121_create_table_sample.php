<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('table_sample', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name',30)->nullable();
            $table->string('email')->nullable();
            $table->string('password');
            $table->tinyInteger('status')->default(1);
            $table->text('address')->nullable();
            $table->mediumText('personal_information')->nullable();
            $table->unsignedMediumInteger('login_count')->default(0);
            $table->string('ip_address',45)->nullable();//39 also give for ipv6--> max char
            $table->dateTime('validity')->nullable();
            $table->unsignedSmallInteger('total_users')->default(99);
            $table->json('more_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_sample');
    }
};
