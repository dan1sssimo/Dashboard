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
            $table->id();
            $table->string('name');
            $table->string('email', 125)->unique('email_unique');
            $table->string('company_title');
            $table->string('image')->nullable();
            $table->string('admin')->nullable();
            $table->string('manager')->nullable();
            $table->string('chief')->nullable();
            $table->string('teamlead')->nullable();
            $table->string('company')->nullable();
            $table->string('passed')->nullable();
            $table->string("tariff")->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
