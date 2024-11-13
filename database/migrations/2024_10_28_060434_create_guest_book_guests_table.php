<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() : void
    {
        Schema::create('guest_book_guest', function (Blueprint $table) {
            $table->unsignedBigInteger('guest_id');
            $table->unsignedBigInteger('guest_book_id');

            // Foreign key constraints
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');
            $table->foreign('guest_book_id')->references('id')->on('guest_books')->onDelete('cascade');
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('guest_book_guest');
    }
};
