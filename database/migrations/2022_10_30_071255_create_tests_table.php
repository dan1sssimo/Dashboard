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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrainted('id')->on('users')->onDelete('cascade')->nullable();
            $table->string('users_name')->index('NAMES');
            $table->string('users_email')->index('EMAILS');
            $table->string('users_post')->index('POSTS');
            $table->json('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
};
