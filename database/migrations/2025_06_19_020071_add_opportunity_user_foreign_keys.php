<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('opportunity_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('opportunity_id')->references('id')->on('opportunities')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('opportunity_user', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['opportunity_id']);
        });
    }
}; 