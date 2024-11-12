<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGuestIdToGuestBooksTable extends Migration
{
    public function up(): void
    {
        Schema::table('guest_books', function (Blueprint $table) {
            $table->foreignId('guest_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('guest_books', function (Blueprint $table) {
            $table->dropForeign(['guest_id']);
            $table->dropColumn('guest_id');
        });
    }
};
