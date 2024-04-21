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
        Schema::create('book_borrowal_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('book_id')->index();
            $table->date('borrowal_date');
            $table->date('return_date')->nullable();
            $table->integer('days_count');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('library_users');
            $table->foreign('book_id')->references('id')->on('books');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_borrowal_data');
    }
};
