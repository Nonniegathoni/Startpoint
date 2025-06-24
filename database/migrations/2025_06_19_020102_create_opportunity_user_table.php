<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('opportunity_user', function (Blueprint $table) {
            $table->id(); // Diagram shows an id, so we add it.
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('opportunity_id')->constrained('opportunities')->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            // No timestamps needed for a simple pivot table like this.
        });
    }
    public function down(): void {
        Schema::dropIfExists('opportunity_user');
    }
};